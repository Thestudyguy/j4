<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Chatbot extends Controller
{
    public function respond(Request $request)
    {
        $message = strtolower(trim($request->input('message')));

        // 1️⃣ Greetings
        if (preg_match('/\b(hi|hello|hey|good morning|good afternoon|good evening)\b/', $message)) {
            return $this->reply('Hello! 👋 How can I help you today?');
        }

        // 2️⃣ Clinic hours
        if (preg_match('/(hour|open|close|time|schedule)/', $message)) {
            return $this->reply('🕒 Our clinic is open from 9 AM to 6 PM, Monday to Saturday.');
        }

        // 3️⃣ Location
        if (preg_match('/(where|location|address|situated|place)/', $message)) {
            return $this->reply('📍 We are located at ABC Building, Main Street, Panabo City.');
        }

        // 4️⃣ Appointment booking
        if (preg_match('/(book|appointment|reserve|schedule)/', $message)) {
            return $this->reply('📅 To book an appointment, please make sure you have an account with us.  
Here’s how it works:  
<br><br>
1️⃣ <b>Create your account</b> – Click the button below to register.  
<br>
2️⃣ <b>Complete your profile</b> – Fill in your personal details.  
<br>
3️⃣ <b>Finish your medical history form</b> – So our doctors can review before your visit.  
<br>
4️⃣ <b>Accept our terms and conditions</b>.  
<br>
5️⃣ <b>Book your appointment</b> – Once everything’s set, you can choose your preferred date and time.  
<br><br>
After registration, you’ll be automatically logged in and can monitor all your appointments anytime through your account dashboard.  
<br><br>
<a href="' . route('register') . '" target="_blank">
    <button style="background-color: #20536B; font-size: 12px;" class="text-white btn rounded-5 p-2 mx-2 px-4">
        CREATE AN ACCOUNT & START BOOKING
    </button>
</a>');
        }
        // 8️⃣ Doctors information
        if (preg_match('/(doctor|dentist|specialist|physician|who|expert)/', $message)) {
            $doctors = DB::table('doctors')
                ->where('isVisible', true)
                ->where('isRemoved', false)
                ->get();

            if ($doctors->isEmpty()) {
                return $this->reply('👨‍⚕️ We currently have no doctors listed, please check back later.');
            }

            $reply = '<div>👨‍⚕️ Here are some of our doctors/dentists:</div><br><ul style="padding-left: 15px;">';
            foreach ($doctors as $doc) {
                $fullName = trim($doc->ProfessionalTitle . ' ' . $doc->FirstName . ' ' . $doc->MiddleName . ' ' . $doc->LastName . ' ' . $doc->Suffix);
                $reply .= '<li><b>' . e($fullName) . '</b>';

                $reply .= ' – ' . e($doc->AreaOfExpertise ?? 'No specialization listed');

                $reply .= '</li>';
            }
            $reply .= '</ul>';

            return $this->reply($reply);
        }



        // 5️⃣ Insurance
        // if (preg_match('/(insurance|coverage|hmo)/', $message)) {
        //     return $this->reply('💳 Yes! We accept most insurance providers. Please contact us to confirm yours.');
        // }

        // 6️⃣ Services (from database)
        if (preg_match('/(service|offer|treatment|do you have)/', $message)) {
            $services = DB::table('services')->pluck('Service')->toArray();
            if (empty($services)) {
                return $this->reply('🦷 We currently have no services listed, please check again later.');
            }
            $list = implode(', ', $services);
            return $this->reply("🦷 We currently offer the following services:\n$list.");
        }

        // 7️⃣ Sub-services or prices
        if (preg_match('/(price|cost|fee|how much)/', $message)) {
            $subservices = DB::table('sub_services')
                ->select('Service', 'Price')
                ->limit(5)
                ->get();

            if ($subservices->isEmpty()) {
                return $this->reply('💰 Price information is not available right now.');
            }

            $reply = '<div>💰 <b>Here are some sample service prices:</b></div><br><ul style="padding-left: 15px;">';
            foreach ($subservices as $item) {
                $reply .= '<li><b>' . e($item->Service) . ':</b> ₱' . number_format($item->Price, 2) . '</li>';
            }
            $reply .= '</ul>
    <div style="margin-top: 10px;">
        🦷 For the full list of services and prices, please check the Services section on this page.
    </div>';

            return $this->reply($reply);
        }


        // 8️⃣ Default fallback
        return $this->reply("🤔 I'm not sure I understand. You can ask about our services, hours, location, or prices!");
    }

    private function reply($text)
    {
        return response()->json(['reply' => $text]);
    }
}
