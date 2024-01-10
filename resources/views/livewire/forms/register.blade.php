<div class="flex flex-col xl:flex-row min-h-[680px] justify-center text-center items-stretch bg-white py-[50px] xl:py-0">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8] mb-0">
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player src="https://lottie.host/efd12853-25b1-4c36-bf27-3d0efb0eea46/mtnAb2oVRI.json"
            background="transparent" speed="1" style="width: 300px; height: 300px; margin: 0 auto;" loop
            autoplay></dotlottie-player>
    </div>
    <div class="w-full xl:w-6/12 flex flex-col justify-center px-[56px] py-[30px] loginwrap">
        <h2 class="font-medium text-base mb-5">Welcome Back !</h2>
        <p class="text-sm	font-normal mb-[40px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <form wire:submit="register">
            <div class="form-item mb-[15px]">
                <input type="text" id="fname" class="w-full rounded-lg" required autocomplete="off"
                    wire:model="fname">
                <label for="fname">First Name</label>
            </div>
            <div class="form-item mb-[15px]">
                <input type="text" id="lname" class="w-full rounded-lg" required autocomplete="off"
                    wire:model="lname">
                <label for="lname">Last Name</label>
            </div>
            <div class="form-item mb-[15px]">
                <input type="text" id="email" class="w-full rounded-lg" required autocomplete="off"
                    wire:model="email">
                <label for="email">Enter email address</label>
            </div>
            <div class="form-item mb-[15px] flex gap-2 items-center">
                <div class="flex items-center gap-2 px-[16px] h-[56px] rounded-md continent">
                    <span>IND</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M0 14.7094V17.8836C0 19.1997 1.04516 20.1287 2.32258 20.1287H21.6774C22.9548 20.1287 24 19.1997 24 17.8836V14.7094H0Z"
                            fill="#359846" />
                        <path
                            d="M21.6774 3.87088H2.32258C1.04516 3.87088 0 4.79991 0 6.11604V9.29023H24V6.11604C24 4.79991 22.9548 3.87088 21.6774 3.87088Z"
                            fill="#EA8634" />
                        <path d="M24 9.29062H0V14.71H24V9.29062Z" fill="#FDFDFD" />
                        <path
                            d="M11.9993 9.56136C10.6444 9.56136 9.56055 10.6452 9.56055 12.0001C9.56055 13.3549 10.6444 14.4388 11.9993 14.4388C13.3541 14.4388 14.438 13.3549 14.438 12.0001C14.438 10.6452 13.3541 9.56136 11.9993 9.56136ZM14.0122 12.271C14.0122 12.3097 14.0509 12.3872 14.0896 12.3872C14.0509 12.5033 14.0509 12.6194 14.0122 12.7355C13.9734 12.6968 13.896 12.7355 13.8573 12.7743C13.8186 12.813 13.8573 12.8904 13.896 12.9291C13.8573 13.0452 13.7799 13.1226 13.7412 13.2388C13.7025 13.2001 13.6251 13.2001 13.5864 13.2775C13.5476 13.3162 13.5476 13.3936 13.5864 13.4323C13.5476 13.471 13.5089 13.5097 13.4702 13.5485L12.6186 12.5807L12.2702 12.3097L12.3089 12.271L12.6573 12.542L13.7799 13.1226L12.7734 12.3485L12.3864 12.1936C12.3864 12.1549 12.3864 12.1549 12.4251 12.1162L12.8122 12.271L14.0509 12.542L12.8509 12.1549L12.4251 12.0775C12.4251 12.0388 12.4251 12.0388 12.4251 12.0001L12.8509 12.0388L14.1283 11.9614L12.8509 11.8839L12.4251 11.9226C12.4251 11.8839 12.4251 11.8839 12.4251 11.8452L12.8509 11.7678L14.0509 11.3807L12.8122 11.6517L12.4251 11.8065C12.4251 11.7678 12.4251 11.7678 12.3864 11.7291L12.7734 11.5743L13.8573 10.8775L12.7347 11.4581L12.3864 11.7291L12.3476 11.6904L12.696 11.4194L13.5476 10.4517C13.5864 10.4904 13.6251 10.5291 13.6638 10.5678C13.6251 10.6065 13.6251 10.6839 13.6638 10.7226C13.7025 10.7614 13.7799 10.7614 13.8186 10.7614C13.896 10.8388 13.9347 10.9549 13.9734 11.071C13.9347 11.1097 13.896 11.1485 13.9347 11.2259C13.9734 11.2646 14.0122 11.3033 14.0896 11.2646C14.1283 11.3807 14.167 11.4968 14.167 11.613C14.1283 11.613 14.0896 11.6904 14.0896 11.7291C14.0896 11.7678 14.167 11.8452 14.2057 11.8065C14.2057 11.8452 14.2057 11.9226 14.2057 11.9614C14.2057 12.0001 14.2057 12.0775 14.2057 12.1162C14.0509 12.1549 14.0122 12.1936 14.0122 12.271ZM10.6444 10.3743C10.6831 10.413 10.7605 10.413 10.7993 10.3743C10.838 10.3355 10.838 10.2581 10.838 10.2194C10.9154 10.142 11.0315 10.1033 11.1476 10.0646C11.1864 10.1033 11.2251 10.142 11.3025 10.1033C11.3412 10.0646 11.3799 10.0259 11.3412 9.94845C11.4573 9.90974 11.5734 9.87103 11.6896 9.87103C11.6896 9.90974 11.767 9.94845 11.8057 9.94845C11.8444 9.94845 11.9218 9.87103 11.8831 9.83232C11.9218 9.83232 11.9993 9.83232 12.038 9.83232C12.0767 9.83232 12.1541 9.83232 12.1928 9.83232C12.1928 9.87103 12.2315 9.94845 12.2702 9.94845C12.3089 9.94845 12.3864 9.90974 12.3864 9.87103C12.5025 9.90974 12.6186 9.90974 12.7347 9.94845C12.696 9.98716 12.7347 10.0646 12.7734 10.1033C12.8122 10.142 12.8896 10.1033 12.9283 10.0646C13.0444 10.1033 13.1218 10.1807 13.238 10.2194C13.1993 10.2581 13.1993 10.3355 13.2767 10.3743C13.3154 10.413 13.3928 10.413 13.4315 10.3743C13.4702 10.413 13.5089 10.4517 13.5476 10.4904L12.5799 11.342L12.3089 11.6904L12.2702 11.6517L12.5412 11.3033L13.1218 10.1807L12.3476 11.2259L12.1928 11.613C12.1541 11.613 12.1541 11.613 12.1154 11.5743L12.2702 11.1872L12.5412 9.94845L12.1541 11.1485L12.0767 11.5743C12.038 11.5743 12.038 11.5743 11.9993 11.5743L12.038 11.1485L11.9993 9.87103L11.9218 11.1485L11.9605 11.5743C11.9218 11.5743 11.9218 11.5743 11.8831 11.5743L11.8057 11.1485L11.4186 9.94845L11.6896 11.1872L11.8444 11.5743C11.8057 11.5743 11.8057 11.5743 11.767 11.613L11.6122 11.2259L10.9154 10.142L11.496 11.2646L11.767 11.613L11.7283 11.6517L11.4573 11.3033L10.4896 10.4517C10.5283 10.4517 10.567 10.413 10.6444 10.3743ZM10.4896 13.5097C10.4509 13.471 10.4122 13.4323 10.3734 13.3936C10.4122 13.3549 10.4122 13.2775 10.3734 13.2388C10.3347 13.2001 10.2573 13.2001 10.2186 13.2001C10.1412 13.1226 10.1025 13.0065 10.0638 12.8904C10.1025 12.8517 10.1412 12.813 10.1025 12.7355C10.0638 12.6968 10.0251 12.6581 9.94764 12.6968C9.90893 12.5807 9.87022 12.4646 9.87022 12.3485C9.90893 12.3485 9.94764 12.271 9.94764 12.2323C9.94764 12.1936 9.87022 12.1162 9.83151 12.1549C9.83151 12.1162 9.83151 12.0388 9.83151 12.0001C9.83151 11.9614 9.83151 11.8839 9.83151 11.8452C9.87022 11.8452 9.94764 11.8065 9.94764 11.7678C9.94764 11.7291 9.90893 11.6517 9.87022 11.6517C9.90893 11.5355 9.90893 11.4194 9.94764 11.3033C9.98635 11.342 10.0638 11.3033 10.1025 11.2646C10.1412 11.2259 10.1025 11.1485 10.0638 11.1097C10.1025 10.9936 10.1799 10.9162 10.2186 10.8001C10.2573 10.8388 10.3347 10.8388 10.3734 10.7614C10.4122 10.6839 10.4122 10.6452 10.3734 10.6065C10.4122 10.5678 10.4509 10.5291 10.4896 10.4904L11.3412 11.4581L11.6896 11.7291L11.6509 11.7678L11.3025 11.4968L10.1799 10.9162L11.2638 11.613L11.6509 11.7678C11.6509 11.8065 11.6509 11.8065 11.6122 11.8452L11.2251 11.6904L9.98635 11.4194L11.1864 11.8065L11.6122 11.8839C11.6122 11.9226 11.6122 11.9226 11.6122 11.9614L11.1864 11.9226L9.87022 12.0001L11.1476 12.0775L11.5734 12.0388C11.5734 12.0775 11.5734 12.0775 11.5734 12.1162L11.1476 12.1936L9.94764 12.5807L11.1864 12.3097L11.5734 12.1549C11.5734 12.1936 11.5734 12.1936 11.6122 12.2323L11.2251 12.3872L10.1412 13.0839L11.2638 12.5033L11.6122 12.2323L11.6509 12.271L11.3025 12.542L10.4896 13.5097ZM11.8444 14.1291C11.8444 14.0904 11.8057 14.013 11.767 14.013C11.7283 14.013 11.6509 14.0517 11.6509 14.0904C11.5347 14.0517 11.4186 14.0517 11.3025 14.013C11.3412 13.9743 11.3025 13.8968 11.2638 13.8581C11.2251 13.8194 11.1476 13.8581 11.1089 13.8968C10.9928 13.8581 10.9154 13.7807 10.7993 13.742C10.838 13.7033 10.838 13.6259 10.7605 13.5872C10.7218 13.5485 10.6444 13.5485 10.6057 13.5872C10.567 13.5485 10.5283 13.5097 10.4896 13.471L11.4573 12.6194L11.7283 12.271L11.767 12.3097L11.496 12.6581L10.9154 13.7807L11.6122 12.6968L11.767 12.3097C11.8057 12.3097 11.8057 12.3097 11.8444 12.3485L11.6896 12.7355L11.4186 13.9743L11.8057 12.7743L11.8831 12.3485C11.9218 12.3485 11.9218 12.3485 11.9605 12.3485L11.9218 12.7743L11.9993 14.0517L12.0767 12.7743L12.038 12.3485C12.0767 12.3485 12.0767 12.3485 12.1154 12.3485L12.1928 12.7743L12.5799 13.9743L12.3089 12.7355L12.1541 12.3485C12.1928 12.3485 12.1928 12.3485 12.2315 12.3097L12.3864 12.6968L13.0831 13.7807L12.5025 12.6581L12.2315 12.3097L12.2702 12.271L12.5412 12.6194L13.5089 13.471C13.4702 13.5097 13.4315 13.5485 13.3928 13.5872C13.3541 13.5485 13.2767 13.5485 13.238 13.5872C13.1993 13.6259 13.1993 13.7033 13.1993 13.742C13.1218 13.8194 13.0057 13.8581 12.8896 13.8968C12.8509 13.8581 12.8122 13.8194 12.7347 13.8581C12.6573 13.8968 12.6573 13.9355 12.696 14.013C12.5799 14.0517 12.4638 14.0904 12.3476 14.0904C12.3476 14.0517 12.2702 14.013 12.2315 14.013C12.1928 14.013 12.1154 14.0904 12.1541 14.1291C12.1154 14.1291 12.038 14.1291 11.9993 14.1291C11.9605 14.1291 11.8831 14.1291 11.8444 14.1291Z"
                            fill="#7D7DBC" />
                        <path d="M12.5415 12.4643L12.6576 12.5805V12.5417L12.5415 12.4643Z" fill="#6060B2" />
                        <path
                            d="M12.0006 9.56136C11.2652 9.56136 10.6071 9.90974 10.1426 10.413L10.3748 10.6065C10.4135 10.5678 10.4523 10.5291 10.491 10.4904C10.5297 10.4517 10.5684 10.413 10.6071 10.3743C10.6458 10.413 10.7232 10.413 10.7619 10.3743C10.8006 10.3355 10.8006 10.2581 10.8006 10.2194C10.8394 10.1807 10.9168 10.1807 10.9555 10.142L11.5361 11.2646L11.8071 11.613L11.7684 11.6517L11.4974 11.3033L10.5297 10.4517L11.3426 11.3807L11.4587 11.4581L11.691 11.6517L12.349 12.1936L12.3877 12.1549L12.7361 12.4259L13.8587 13.0065C13.82 13.0452 13.82 13.1226 13.7813 13.1614C13.7426 13.1226 13.6652 13.1226 13.6264 13.2001C13.5877 13.2388 13.5877 13.3162 13.6264 13.3549L13.8587 13.5485C14.2071 13.1226 14.4394 12.5807 14.4394 11.9614C14.4394 10.6452 13.3555 9.56136 12.0006 9.56136ZM11.8071 11.613L11.6523 11.2259L10.9555 10.1807C10.9942 10.142 11.0329 10.1033 11.1103 10.1033C11.149 10.142 11.1877 10.1807 11.2652 10.142C11.3039 10.1033 11.3426 10.0646 11.3039 9.98716C11.3426 9.98716 11.42 9.94845 11.4587 9.94845L11.7297 11.1872L11.8845 11.5743C11.8458 11.613 11.8458 11.613 11.8071 11.613ZM12.0394 11.5743L12.0781 11.1485L12.0006 9.87103L11.9232 11.1485L11.9619 11.5743C11.9232 11.5743 11.9232 11.5743 11.8845 11.5743L11.8071 11.1485L11.42 9.94845C11.4587 9.94845 11.5361 9.90974 11.5748 9.90974C11.5748 9.94845 11.6523 9.98716 11.691 9.98716C11.7297 9.98716 11.8071 9.90974 11.7684 9.87103C11.8071 9.87103 11.8845 9.87103 11.9232 9.87103C11.9619 9.87103 12.0394 9.87103 12.0781 9.87103C12.0781 9.90974 12.1168 9.98716 12.1555 9.98716C12.1942 9.98716 12.2716 9.94845 12.2716 9.90974C12.3103 9.90974 12.3877 9.94845 12.4264 9.94845L12.0394 11.1485L11.9619 11.5743C12.0781 11.5743 12.0394 11.5743 12.0394 11.5743ZM12.1168 11.613L12.2716 11.2259L12.5426 9.98716C12.5813 9.98716 12.6587 10.0259 12.6974 10.0259C12.6587 10.0646 12.6974 10.142 12.7361 10.1807C12.7748 10.2194 12.8523 10.1807 12.891 10.142C12.9297 10.1807 13.0071 10.1807 13.0458 10.2194L12.349 11.2259L12.1942 11.613C12.1555 11.613 12.1555 11.613 12.1168 11.613ZM13.8587 12.7743C13.82 12.813 13.8587 12.8904 13.8974 12.9291C13.8587 12.9678 13.8587 13.0452 13.82 13.0839L12.7748 12.3485L12.3877 12.1936C12.3877 12.1549 12.3877 12.1549 12.4264 12.1162L12.8135 12.271L14.0523 12.542C14.0523 12.5807 14.0135 12.6581 14.0135 12.6968C13.9361 12.6968 13.8974 12.7355 13.8587 12.7743ZM14.1297 11.8452C14.1297 11.8839 14.1297 11.9614 14.1297 12.0001C14.1297 12.0388 14.1297 12.1162 14.1297 12.1549C14.091 12.1549 14.0135 12.1936 14.0135 12.2323C14.0135 12.271 14.0523 12.3485 14.091 12.3485C14.091 12.3872 14.0523 12.4646 14.0523 12.5033L12.8523 12.1162L12.4264 12.0388C12.4264 12.0001 12.4264 12.0001 12.4264 11.9614L12.8523 12.0001L14.1297 11.9226L12.8523 11.8452L12.4264 11.8839C12.4264 11.8452 12.4264 11.8452 12.4264 11.8065L12.8523 11.7291L14.0523 11.342C14.0523 11.3807 14.091 11.4581 14.091 11.4968C14.0523 11.4968 14.0135 11.5743 14.0135 11.613C14.0135 11.8065 14.0523 11.8452 14.1297 11.8452ZM13.8587 11.2259C13.8974 11.2646 13.9361 11.3033 14.0135 11.2646C14.0135 11.3033 14.0523 11.3807 14.0523 11.4194L12.8135 11.6904L12.4264 11.8452C12.4264 11.8065 12.4264 11.8065 12.3877 11.7678L12.7748 11.613L13.82 10.9162C13.8587 10.9549 13.8974 10.9936 13.8974 11.071C13.8587 11.1097 13.82 11.1872 13.8587 11.2259ZM13.82 10.9549L12.6974 11.5355L12.349 11.8065L12.3103 11.7678L12.6587 11.4968L13.5103 10.5291L12.5426 11.3807L12.2716 11.7291L12.2329 11.6904L12.5039 11.342L13.0845 10.2194C13.1232 10.2581 13.2006 10.2581 13.2394 10.2968C13.2006 10.3355 13.2006 10.413 13.2781 10.4517C13.3168 10.4904 13.3942 10.4904 13.4329 10.4517C13.4716 10.4904 13.5103 10.5291 13.549 10.5678C13.5877 10.6065 13.6264 10.6452 13.6652 10.6839C13.6264 10.7226 13.6264 10.8001 13.6652 10.8388C13.7039 10.8775 13.7813 10.8775 13.82 10.8775C13.7813 10.8388 13.82 10.8775 13.82 10.9549Z"
                            fill="#6060B2" />
                    </svg>
                </div>
                <div class="relative w-full">
                    <input type="tel" id="mob" class="w-full rounded-lg" required autocomplete="off"
                        wire:model="mobile">
                    <label for="mob">+91 Mobile Number</label>
                </div>
            </div>
            <div class="form-item mb-[15px] relative">
                <span class="show-password" onclick="showPassword('regpassword')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                        fill="none" class="eye">
                        <path
                            d="M21.8035 10.6702C21.7659 10.607 20.8612 9.10512 19.0852 7.59752C16.7236 5.59286 13.9278 4.5332 11 4.5332C8.07224 4.5332 5.27643 5.59281 2.91483 7.59748C1.13876 9.10512 0.234137 10.607 0.196496 10.6702L0 11L0.196496 11.3299C0.234137 11.3931 1.1388 12.895 2.91483 14.4026C5.27643 16.4072 8.07224 17.4669 11 17.4669C13.9278 17.4669 16.7236 16.4073 19.0852 14.4026C20.8612 12.895 21.7659 11.3932 21.8035 11.33L22 11L21.8035 10.6702ZM18.2508 13.4197C16.095 15.2497 13.6555 16.1776 11 16.1776C8.35931 16.1776 5.93128 15.2594 3.78323 13.4485C2.63196 12.4779 1.87172 11.495 1.52346 10.9994C1.86656 10.5101 2.61121 9.54641 3.74915 8.58043C5.90498 6.75039 8.34453 5.82252 11 5.82252C13.6407 5.82252 16.0687 6.74068 18.2168 8.5516C19.368 9.52222 20.1282 10.5052 20.4765 11.0007C20.1334 11.49 19.3888 12.4537 18.2508 13.4197Z"
                            fill="#686E70" />
                        <path
                            d="M11.0002 6.78442C8.67572 6.78442 6.78467 8.67548 6.78467 11C6.78467 13.3244 8.67572 15.2155 11.0002 15.2155C13.3247 15.2155 15.2157 13.3244 15.2157 11C15.2157 8.67548 13.3247 6.78442 11.0002 6.78442ZM11.0002 13.9262C9.38664 13.9262 8.07394 12.6135 8.07394 11C8.07394 9.3864 9.38664 8.0737 11.0002 8.0737C12.6138 8.0737 13.9265 9.3864 13.9265 11C13.9265 12.6135 12.6138 13.9262 11.0002 13.9262Z"
                            fill="#686E70" />
                        <path
                            d="M11.0004 11.8476C11.4685 11.8476 11.848 11.4681 11.848 11C11.848 10.5319 11.4685 10.1525 11.0004 10.1525C10.5323 10.1525 10.1528 10.5319 10.1528 11C10.1528 11.4681 10.5323 11.8476 11.0004 11.8476Z"
                            fill="#686E70" />
                    </svg>
                </span>
                <input type="password" id="regpassword" class="w-full rounded-lg passwordOverlay" required autocomplete="off"
                    wire:model="password">
                <label for="password" class="overlayLabel">Enter Password</label>
            </div>
            <button type="submit" class="login-btn" @click="isEmailVerificationFormOpen = true">Sign up</button>

            <span class="divider-or mt-[20px]">OR</span>
            <ul class="flex justify-center items-center my-[20px]">
                <li class="mx-[7px]"><a href="#" class="log-google flex items-center px-[40px] py-[10px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                            fill="none" class="mr-[10px]">
                            <path
                                d="M3.98918 10.8764L3.36262 13.2154L1.07258 13.2638C0.388195 11.9945 0 10.5421 0 8.99876C0 7.50634 0.362953 6.09896 1.00631 4.85974H1.0068L3.04559 5.23352L3.9387 7.26007C3.75177 7.80503 3.64989 8.39003 3.64989 8.99876C3.64996 9.65941 3.76963 10.2924 3.98918 10.8764Z"
                                fill="#FBBB00" />
                            <path
                                d="M17.8417 7.31848C17.945 7.86291 17.9989 8.42516 17.9989 8.99979C17.9989 9.64414 17.9312 10.2727 17.8021 10.8789C17.364 12.942 16.2192 14.7435 14.6333 16.0183L14.6328 16.0178L12.0649 15.8868L11.7014 13.618C12.7537 13.0009 13.5761 12.0351 14.0093 10.8789H9.19678V7.31848H14.0795H17.8417Z"
                                fill="#518EF8" />
                            <path
                                d="M14.6331 16.0184L14.6336 16.0189C13.0912 17.2586 11.132 18.0004 8.9992 18.0004C5.57178 18.0004 2.5919 16.0847 1.07178 13.2655L3.98837 10.8781C4.74842 12.9065 6.70518 14.3505 8.9992 14.3505C9.98522 14.3505 10.909 14.0839 11.7017 13.6186L14.6331 16.0184Z"
                                fill="#28B446" />
                            <path
                                d="M14.7437 2.07209L11.8281 4.45906C11.0077 3.94627 10.038 3.65004 8.99906 3.65004C6.65312 3.65004 4.65976 5.16025 3.93779 7.26143L1.00586 4.86111H1.00537C2.50324 1.9732 5.5207 0.00012207 8.99906 0.00012207C11.1828 0.00012207 13.185 0.777989 14.7437 2.07209Z"
                                fill="#F14336" />
                        </svg>
                        Google</a></li>
                <li class="mx-[7px]"><a href="#" class="log-fb flex items-center p-[40px] py-[10px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="18" viewBox="0 0 10 18"
                            fill="none" class="mr-[10px]">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 0.129808V2.98558H8.18287C6.75926 2.98558 6.49306 3.6238 6.49306 4.54327V6.58774H9.88426L9.43287 9.78966H6.49306V18H2.95139V9.78966H0V6.58774H2.95139V4.22957C2.95139 1.49279 4.74537 0 7.36111 0C8.61111 0 9.6875 0.0865385 10 0.129808Z"
                                fill="#3B5998" />
                        </svg>
                        Facebook</a></li>
            </ul>
            <h5 class="text-base text-[#3D3D3D]" @click="isLoginFormOpen = true;isRegisterFormOpen = false;">Already
                Registered? Login.</h5>
            <p class="text-[12px] text-[#3D3D3D]">By signing in, you confirm that you have read and agree to our <a
                    href="#" class="text-[#3362CC] block">Trems and Conditions</a></p>
        </form>
    </div>
</div>
<script>
    // restrict label animation
    document.querySelectorAll('input').forEach(function(input) {
      input.addEventListener('focus', function() {
        this.nextElementSibling.style.top = '-5px';
        this.nextElementSibling.style.fontSize = '11px';
        this.nextElementSibling.style.color = '#3362CC';
        this.nextElementSibling.style.zIndex = '1';
      });

      input.addEventListener('blur', function() {
        if (!this.value) {
          this.nextElementSibling.style.top = '';
          this.nextElementSibling.style.fontSize = '';
          this.nextElementSibling.style.color = '';
          this.nextElementSibling.style.zIndex = '0';
        }
      });
    });

    // show hide function
    function showPassword(targetID) {
        var x = document.getElementById(targetID);
        var img = document.querySelector('.eye')
        if (x.type === "password") {
            x.type = "text";
            img.style.opacity = "0.5";
        } else {
            x.type = "password";
            img.style.opacity = "1";
        }
    }
</script>
