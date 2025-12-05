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

        // 5️⃣ Doctors information
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
                $reply .= '<li><b>' . e($fullName) . '</b> – ' . e($doc->AreaOfExpertise ?? 'No specialization listed') . '</li>';
            }
            $reply .= '</ul>';

            return $this->reply($reply);
        }

        // 6️⃣ Services overview
        if (preg_match('/(service|offer|treatment|do you have)/', $message)) {
            $services = DB::table('services')->pluck('Service')->toArray();
            if (empty($services)) {
                return $this->reply('🦷 We currently have no services listed, please check again later.');
            }
            $list = implode(', ', $services);
            return $this->reply("🦷 We currently offer the following services:\n$list.");
        }

        // 7️⃣ Sample prices
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

        // 8️⃣ Sub-service detailed lookup
        $subService = DB::table('sub_services')
            ->where('Service', 'like', '%' . $message . '%')
            ->first();

        if ($subService) {
            $reply = '<div>🦷 <b>Service Details:</b></div><br><ul style="padding-left: 15px;">';
            $reply .= '<li><b>Service:</b> ' . e($subService->Service) . '</li>';
            $reply .= '<li><b>Price:</b> ₱' . number_format($subService->Price, 2) . '</li>';
            if (!empty($subService->Description)) {
                $reply .= '<li><b>Description:</b> ' . e($subService->Description) . '</li>';
            }
            if (!empty($subService->Duration)) {
                $reply .= '<li><b>Duration:</b> ' . e($subService->Duration) . '</li>';
            }
            $reply .= '</ul>';
            return $this->reply($reply);
        }

        // 9️⃣ Emergency cases
        if (preg_match('/(emergency|urgent|pain|bleeding|broken)/', $message)) {
            return $this->reply('🚨 If you are experiencing a dental emergency such as severe pain, uncontrolled bleeding, or a broken tooth, please contact us immediately at <b>(0912) 345-6789</b> or visit our clinic. Your safety is our priority!');
        }

        // 🔟 Payment methods
        if (preg_match('/(payment|pay|method|cash|credit|gcash|online)/', $message)) {
            return $this->reply('💳 We accept cash, credit/debit cards, and GCash payments for your convenience. Please ask our front desk for assistance during your visit.');
        }

        // 1️⃣1️⃣ Dental hygiene tips
        if (preg_match('/(clean|brush|floss|hygiene|care)/', $message)) {
            return $this->reply('🪥 Here are some quick dental care tips: <br>
1️⃣ Brush your teeth twice daily using fluoride toothpaste. <br>
2️⃣ Floss once a day to remove plaque between teeth. <br>
3️⃣ Limit sugary snacks and drinks. <br>
4️⃣ Visit your dentist regularly for check-ups and cleanings.');
        }

        // 1️⃣2️⃣ Teeth whitening
        if (preg_match('/(whiten|bleach|bright|smile)/', $message)) {
            return $this->reply('✨ Yes! We offer professional teeth whitening treatments to give you a brighter, confident smile. Schedule a consultation to see which option is best for you.');
        }

        // 1️⃣3️⃣ Kids dentistry
        if (preg_match('/(child|kids|pediatric|baby|teeth)/', $message)) {
            return $this->reply('🧸 We have specialized pediatric dental care to ensure your children have a comfortable and fun dental experience. From routine check-ups to preventive care, we make sure little smiles stay healthy!');
        }

        // 1️⃣4️⃣ Cosmetic dentistry
        if (preg_match('/(cosmetic|veneers|bonding|smile makeover)/', $message)) {
            return $this->reply('😃 Our cosmetic dentistry services include veneers, bonding, and full smile makeovers. We can help you achieve the smile you’ve always wanted!');
        }

        // 1️⃣5️⃣ Oral surgery
        if (preg_match('/(surgery|extract|wisdom tooth|implant|operation)/', $message)) {
            return $this->reply('🦷 We provide safe oral surgical procedures including tooth extractions, wisdom tooth removal, and dental implants, all performed by experienced professionals.');
        }

        // 1️⃣6️⃣ Follow-up appointments
        if (preg_match('/(follow|check-up|review|after|visit)/', $message)) {
            return $this->reply('📅 Follow-up appointments are important for monitoring your dental health. You can book them directly through your account dashboard or call us to schedule.');
        }

        // 1️⃣7️⃣ Promotions or discounts
        if (preg_match('/(discount|promo|offer|sale|deal)/', $message)) {
            return $this->reply('🎉 We occasionally offer promotions and discounts on select treatments. Please check our website or social media pages for the latest deals.');
        }

        // 1️⃣8️⃣ Feedback or complaints
        if (preg_match('/(feedback|complaint|review|problem)/', $message)) {
            return $this->reply('📝 We value your feedback! Please send us your comments or concerns via our contact form or email us at <b>support@ourclinic.com</b>. We strive to improve your experience.');
        }

        // Default fallback
        return $this->reply("🤔 I'm not sure I understand. You can ask about our services, hours, location, or prices!");
    }

    private function reply($text)
    {
        return response()->json(['reply' => $text]);
    }
}
