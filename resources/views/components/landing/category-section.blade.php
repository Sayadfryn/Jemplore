<section class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 mb-20">

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @php
            $categories = [
                [
                    'title' => 'Destinasi',
                    'type' => 'custom',
                    'icon' => 'map-pin'
                ],
                [
                    'title' => 'Kuliner',
                    'type' => 'image',
                    'img' => 'icon-culinary.svg'
                ],
                [
                    'title' => 'Events',
                    'type' => 'image',
                    'img' => 'icon-events.svg'
                ],
                [
                    'title' => 'Packages',
                    'type' => 'image',
                    'img' => 'icon-packages.svg'
                ],
            ];
        @endphp

        @foreach($categories as $item)
            <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center justify-center gap-4 transition-transform hover:-translate-y-2 hover:shadow-2xl cursor-pointer group h-[160px]">

                @if($item['title'] === 'Destinasi')

                    <a href="{{ route('public.destinations') }}" class="w-14 h-14 rounded-2xl bg-gradient-to-b from-[#47b6c2] to-[#5dd2de] flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.9901 9.99506C19.9901 14.9856 14.4538 20.183 12.5947 21.7882C12.4215 21.9184 12.2107 21.9889 11.994 21.9889C11.7773 21.9889 11.5665 21.9184 11.3933 21.7882C9.53424 20.183 3.99799 14.9856 3.99799 9.99506C3.99799 7.87438 4.84042 5.84055 6.33997 4.34101C7.83952 2.84146 9.87334 1.99902 11.994 1.99902C14.1147 1.99902 16.1485 2.84146 17.6481 4.34101C19.1476 5.84055 19.9901 7.87438 19.9901 9.99506Z" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.9941 12.9936C13.6501 12.9936 14.9926 11.6511 14.9926 9.99509C14.9926 8.33906 13.6501 6.99658 11.9941 6.99658C10.338 6.99658 8.99554 8.33906 8.99554 9.99509C8.99554 11.6511 10.338 12.9936 11.9941 12.9936Z" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>

                @elseif(($item['title'] === 'Kuliner'))

                    <a href="{{ route('public.culinary') }}" class="w-14 h-14 rounded-2xl bg-gradient-to-b from-[#47b6c2] to-[#5dd2de] flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.99503 1.99902V3.99902" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.993 1.99902V3.99902" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.9921 7.99609C16.2572 7.99609 16.5114 8.1014 16.6988 8.28884C16.8863 8.47629 16.9916 8.73051 16.9916 8.9956V16.9916C16.9916 18.052 16.5704 19.0689 15.8206 19.8187C15.0708 20.5684 14.0539 20.9896 12.9936 20.9896H6.99655C5.93621 20.9896 4.9193 20.5684 4.16953 19.8187C3.41975 19.0689 2.99854 18.052 2.99854 16.9916V8.9956C2.99854 8.73051 3.10384 8.47629 3.29128 8.28884C3.47873 8.1014 3.73295 7.99609 3.99804 7.99609H17.9911C19.0514 7.99609 20.0683 8.41731 20.8181 9.16709C21.5679 9.91686 21.9891 10.9338 21.9891 11.9941C21.9891 13.0544 21.5679 14.0714 20.8181 14.8211C20.0683 15.5709 19.0514 15.9921 17.9911 15.9921H16.9916" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.99701 1.99902V3.99902" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>

                @elseif(($item['title'] === 'Events'))

                <a href="{{ route('public.events') }}" class="w-14 h-14 rounded-2xl bg-gradient-to-b from-[#47b6c2] to-[#5dd2de] flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.99603 1.99902V5.99704" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15.9921 1.99902V5.99704" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18.9906 3.99805H4.99751C3.89349 3.99805 2.9985 4.89303 2.9985 5.99705V19.9901C2.9985 21.0941 3.89349 21.9891 4.99751 21.9891H18.9906C20.0946 21.9891 20.9896 21.0941 20.9896 19.9901V5.99705C20.9896 4.89303 20.0946 3.99805 18.9906 3.99805Z" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.9985 9.99512H20.9896" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </a>

                @elseif(($item['title'] === 'Packages'))

                <a href="{{ route('public.packages') }}" class="w-14 h-14 rounded-2xl bg-gradient-to-b from-[#47b6c2] to-[#5dd2de] flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.9945 21.7191C11.2984 21.8946 11.6431 21.987 11.994 21.987C12.3449 21.987 12.6897 21.8946 12.9936 21.7191L19.9901 17.7211C20.2937 17.5458 20.5458 17.2938 20.7213 16.9903C20.8967 16.6868 20.9892 16.3425 20.9896 15.992V7.99595C20.9892 7.6454 20.8967 7.30111 20.7213 6.99761C20.5458 6.69411 20.2937 6.44208 19.9901 6.26681L12.9936 2.26879C12.6897 2.09334 12.3449 2.00098 11.994 2.00098C11.6431 2.00098 11.2984 2.09334 10.9945 2.26879L3.99802 6.26681C3.69443 6.44208 3.44227 6.69411 3.26684 6.99761C3.09141 7.30111 2.99887 7.6454 2.99851 7.99595V15.992C2.99887 16.3425 3.09141 16.6868 3.26684 16.9903C3.44227 17.2938 3.69443 17.5458 3.99802 17.7211L10.9945 21.7191Z" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.994 21.9892V11.9941" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3.28841 6.99658L11.9941 11.9941L20.6998 6.99658" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.49628 4.26807L16.4918 9.41551" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

                @endif

                <h3 class="text-[#060b0b] font-medium text-lg text-center">
                    {{ $item['title'] }}
                </h3>

            </div>
        @endforeach

    </div>
</section>
