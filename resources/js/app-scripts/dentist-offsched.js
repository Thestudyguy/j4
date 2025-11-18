$(document).ready(function(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        customClass: {
            popup: 'swal2-toast-popup'
        },
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    let selectedDate = null;
    let selectedTime = null;

    function renderCalendar(calendarId, selectedDateId, timeSlotsId) {
        const calendar = document.getElementById(calendarId);
        const dateObj = new Date();
        let month = dateObj.getMonth();
        let year = dateObj.getFullYear();

        function loadCalendar(m, y) {
            const firstDay = new Date(y, m, 1).getDay();
            const daysInMonth = new Date(y, m + 1, 0).getDate();
            const today = new Date();

            let html = `
                <div class="calendar-header">
                    <button class="btn btn-sm btn-light" id="prev">&lt;</button>
                    <h5 class="m-0">${dateObj.toLocaleString('default', { month: 'long' })} ${y}</h5>
                    <button class="btn btn-sm btn-light" id="next">&gt;</button>
                </div>
                <div class="calendar-grid">
                    <div class="fw-bold">Sun</div>
                    <div class="fw-bold">Mon</div>
                    <div class="fw-bold">Tue</div>
                    <div class="fw-bold">Wed</div>
                    <div class="fw-bold">Thu</div>
                    <div class="fw-bold">Fri</div>
                    <div class="fw-bold">Sat</div>
            `;

            // Empty cells for days before the 1st
            for (let i = 0; i < firstDay; i++) {
                html += `<div class="calendar-empty"></div>`;
            }

            // Create day cells
            for (let d = 1; d <= daysInMonth; d++) {
                let cls = "calendar-cell";
                const cellDate = new Date(y, m, d);

                // Disable past dates
                if (cellDate < new Date(today.getFullYear(), today.getMonth(), today.getDate())) {
                    cls += " calendar-past"; // add a class to style it as disabled
                }

                // Highlight today
                if (d === today.getDate() && m === today.getMonth() && y === today.getFullYear()) {
                    cls += " calendar-today";
                }

                html += `<div class="${cls}" data-date="${y}-${m+1}-${d}">${d}</div>`;
            }

            html += `</div>`;
            calendar.innerHTML = html;

            // Prev / Next
            document.getElementById("prev").onclick = () => {
                month--;
                dateObj.setMonth(month);
                loadCalendar(dateObj.getMonth(), dateObj.getFullYear());
            };
            document.getElementById("next").onclick = () => {
                month++;
                dateObj.setMonth(month);
                loadCalendar(dateObj.getMonth(), dateObj.getFullYear());
            };

            // Click on date
            document.querySelectorAll(`#${calendarId} .calendar-cell`).forEach(cell => {
                if (cell.classList.contains('calendar-past')) return; // skip past dates

                cell.addEventListener("click", function () {
                    let pickedDate = this.getAttribute("data-date");
                    selectedDate = pickedDate;
                    displaySelectedDate(pickedDate, selectedDateId);
                    generateTimeSlots(pickedDate, timeSlotsId);
                });
            });
        }

        loadCalendar(month, year);
    }

    function displaySelectedDate(date, selectedDateId) {
        const el = document.getElementById(selectedDateId);
        el.classList.remove("d-none");
        el.textContent = "Selected Date: " + date;
    }

    function generateTimeSlots(date, timeSlotsId) {
        const slotDiv = document.getElementById(timeSlotsId);
        slotDiv.innerHTML = "";

        // Example slots every hour (customizable)
        let slots = [
            "08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM",
            "12:00 PM", "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM"
        ];

        slots.forEach(time => {
            let div = document.createElement("div");
            div.classList.add("col-3", "slot");
            div.textContent = time;
            
            div.onclick = function () {
                document.querySelectorAll(`#${timeSlotsId} .slot`).forEach(s => s.classList.remove("slot-selected"));
                this.classList.add("slot-selected");
                selectedTime = $(this).text();
            };

            slotDiv.appendChild(div);
        });
    }

    // Event listener for when modal is shown, render calendar for each dentist
    $(document).on('shown.bs.modal', '.modal', function () {
        const dentID = $(this).attr('id').split('-').pop(); // Get the dentist ID from the modal
        renderCalendar(
            `calendar-${dentID}`,
            `selected-date-${dentID}`,
            `time-slots-${dentID}`
        );
    });
$(document).off('click', '.save-dentist-offsched').on('click', '.save-dentist-offsched', function (e) {
    e.preventDefault();

    const dentistID   = $(this).data('dentistid');
    const dentistName = $(this).data('dentistname') || null; // optional: add data-dentistname="{{ $doctor->FirstName }} {{ $doctor->LastName }}" to your button
    const date        = selectedDate; // ensure these are set when user selects
    const time        = selectedTime;

    if (!date) {
        Toast.fire({
            icon: 'warning',
            title: 'Please select a date first'
        });
        return;
    }

    $.ajax({
        url: '/dentist/off-schedule',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            dentist_id: dentistID,
            date: date,
            time: time
        },
        beforeSend() {
            $('.loader-container').removeClass('visually-hidden');
        },
        success(response) {
            localStorage.setItem('offsched', 'save')
            console.log(localStorage.getItem('offsched'));
                location.reload();
            },
        error(xhr) {
            // hide loader
            $('.loader-container').addClass('visually-hidden');

            console.error('Off-schedule save error:', xhr);

            // 1) Validation errors (Laravel 422)
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                const errors = xhr.responseJSON.errors;
                // flatten first few messages into one string
                const messages = Object.keys(errors)
                    .slice(0, 3) // show up to 3 fields
                    .map(k => `${errors[k].join(' ')}`)
                    .join('<br>');

                Toast.fire({
                    icon: 'error',
                    title: 'Validation failed',
                    html: messages,
                    timer: 6000
                });
                return;
            }

            // 2) If server returned JSON with message
            if (xhr.responseJSON && xhr.responseJSON.message) {
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    html: escapeHtml(xhr.responseJSON.message),
                    timer: 5000
                });
                return;
            }

            // 3) Network errors or others
            if (xhr.status === 0) {
                Toast.fire({
                    icon: 'error',
                    title: 'Network error',
                    html: 'Unable to reach the server. Check your connection and try again.',
                    timer: 5000
                });
                return;
            }

            // 4) Generic fallback with status code
            Toast.fire({
                icon: 'error',
                title: `Request failed (${xhr.status})`,
                html: 'Something went wrong. Try again or contact support.',
                timer: 5000
            });
        }
    });
});

function escapeHtml(text) { return text .replace(/&/g, "&amp;") .replace(/</g, "&lt;") .replace(/>/g, "&gt;") .replace(/"/g, "&quot;") .replace(/'/g, "&#039;"); }
    let offsched = localStorage.getItem('offsched')
 if (offsched === 'save') {

        Toast.fire({
            icon: 'success',
            title: 'Off-schedule saved',
            html: `<strong>Off-schedule successfully saved</strong><br>`,
            timer: 3000
        });

        localStorage.removeItem('offsched');
    }
});
