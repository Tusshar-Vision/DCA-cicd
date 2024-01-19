@extends('layouts.base')

@section('content')

<div style="width: 500px; margin: 0 auto">
    <!-- folder header -->
    <div class="flex justify-start items-center w-full text-[#8F93A3] text-sm">
        <a class="mr-[20px]" href="javascript:void(0)">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                <path d="M21.4071 9.56896C21.4064 9.56845 21.4059 9.56778 21.4054 9.56728L12.4311 0.593338C12.0486 0.210647 11.54 -1.00886e-06 10.999 -9.61566e-07C10.4581 -9.14273e-07 9.94949 0.210647 9.5668 0.593338L0.597223 9.56275C0.594202 9.56577 0.591013 9.56896 0.588159 9.57198C-0.197365 10.362 -0.196022 11.6439 0.59202 12.4319C0.952052 12.7921 1.42739 13.0006 1.9358 13.0226C1.95662 13.0246 1.97743 13.0256 1.99841 13.0256L2.35592 13.0256L2.35592 19.6297C2.35592 20.9367 3.4194 22 4.72643 22L8.23745 22C8.59345 22 8.88198 21.7113 8.88198 21.3555L8.88198 16.1778C8.88198 15.5814 9.36723 15.0963 9.96359 15.0963L12.0345 15.0963C12.6308 15.0963 13.1159 15.5814 13.1159 16.1778L13.1159 21.3555C13.1159 21.7113 13.4045 22 13.7605 22L17.2715 22C18.5787 22 19.642 20.9367 19.642 19.6297L19.642 13.0256L19.9736 13.0256C20.5144 13.0256 21.023 12.815 21.4059 12.4321C22.1948 11.6429 22.1951 10.3587 21.4071 9.56896ZM20.4943 11.5207C20.3552 11.6598 20.1702 11.7365 19.9736 11.7365L18.9974 11.7365C18.6414 11.7365 18.3529 12.0251 18.3529 12.3811L18.3529 19.6297C18.3529 20.2259 17.8678 20.711 17.2715 20.711L14.405 20.711L14.405 16.1778C14.405 14.8707 13.3417 13.8073 12.0345 13.8073L9.96359 13.8073C8.6564 13.8073 7.59292 14.8707 7.59292 16.1778L7.59292 20.711L4.72643 20.711C4.13024 20.711 3.64499 20.2259 3.64499 19.6297L3.64499 12.3811C3.64499 12.0251 3.35646 11.7365 3.00046 11.7365L2.04104 11.7365C2.03097 11.7359 2.02107 11.7354 2.01083 11.7352C1.81881 11.7318 1.63871 11.6556 1.50376 11.5205C1.21675 11.2335 1.21675 10.7664 1.50376 10.4792C1.50393 10.4792 1.50393 10.479 1.5041 10.4789L1.5046 10.4784L10.4785 1.50475C10.6175 1.3656 10.8023 1.28906 10.999 1.28906C11.1956 1.28906 11.3804 1.3656 11.5195 1.50475L20.4915 10.4765C20.4928 10.4778 20.4943 10.4792 20.4957 10.4805C20.7812 10.7681 20.7807 11.2342 20.4943 11.5207Z" fill="#979797"/>
              </svg>
        </a>
        <div class="flex justify-start w-full border-[#D8D8D8] border-[1px] rounded-[5px] py-[8px] px-[10px]">
            <ul class="flex folderDrilldown items-center">
                <li class="mr-[5px] relative after:content-['/'] after:ml-[5px]">Paper</li>
                <li class="mr-[5px] relative after:content-['/'] after:ml-[5px]">GS-1</li>
                <li class="mr-[5px] relative after:content-[''] after:ml-[5px]">Economics</li>
            </ul>    
        </div>
    </div>
    <!-- folder body -->
    <div class="flex space-x-4 pt-4 text-[#8F93A3]">
        <div class="w-2/6 px-[10px] py-[15px] bg-[#F9F9F9] overflow-y-auto max-h-[300px]">
            <ul>
                <li class="p-[10px] cursor-pointer hover:bg-[#ECECEC] flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 23 20" fill="none" class="mr-[10px]">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.76 15C21.76 17.2091 19.9691 19 17.76 19H5C2.79086 19 1 17.2091 1 15V5C1 2.79086 2.79086 1 5 1H16V8.57895H21.76V15Z" fill="white"/>
                        <path d="M16 1L21.76 8.57895H16V1Z" fill="#8F93A3"/>
                        <path d="M16 1H5C2.79086 1 1 2.79086 1 5V15C1 17.2091 2.79086 19 5 19H17.76C19.9691 19 21.76 17.2091 21.76 15V8.57895M16 1L21.76 8.57895M16 1V8.57895H21.76" stroke="#E9E9E9" stroke-width="0.8"/>
                    </svg> GS-1
                </li>
                <li class="p-[10px] cursor-pointer hover:bg-[#ECECEC] flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 23 20" fill="none" class="mr-[10px]">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.76 15C21.76 17.2091 19.9691 19 17.76 19H5C2.79086 19 1 17.2091 1 15V5C1 2.79086 2.79086 1 5 1H16V8.57895H21.76V15Z" fill="white"/>
                        <path d="M16 1L21.76 8.57895H16V1Z" fill="#8F93A3"/>
                        <path d="M16 1H5C2.79086 1 1 2.79086 1 5V15C1 17.2091 2.79086 19 5 19H17.76C19.9691 19 21.76 17.2091 21.76 15V8.57895M16 1L21.76 8.57895M16 1V8.57895H21.76" stroke="#E9E9E9" stroke-width="0.8"/>
                    </svg> GS-2
                </li>
                <li class="p-[10px] cursor-pointer hover:bg-[#ECECEC] flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 23 20" fill="none" class="mr-[10px]">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.76 15C21.76 17.2091 19.9691 19 17.76 19H5C2.79086 19 1 17.2091 1 15V5C1 2.79086 2.79086 1 5 1H16V8.57895H21.76V15Z" fill="white"/>
                        <path d="M16 1L21.76 8.57895H16V1Z" fill="#8F93A3"/>
                        <path d="M16 1H5C2.79086 1 1 2.79086 1 5V15C1 17.2091 2.79086 19 5 19H17.76C19.9691 19 21.76 17.2091 21.76 15V8.57895M16 1L21.76 8.57895M16 1V8.57895H21.76" stroke="#E9E9E9" stroke-width="0.8"/>
                    </svg> GS-3
                </li>
                <li class="p-[10px] cursor-pointer hover:bg-[#ECECEC] flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 23 20" fill="none" class="mr-[10px]">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.76 15C21.76 17.2091 19.9691 19 17.76 19H5C2.79086 19 1 17.2091 1 15V5C1 2.79086 2.79086 1 5 1H16V8.57895H21.76V15Z" fill="white"/>
                        <path d="M16 1L21.76 8.57895H16V1Z" fill="#8F93A3"/>
                        <path d="M16 1H5C2.79086 1 1 2.79086 1 5V15C1 17.2091 2.79086 19 5 19H17.76C19.9691 19 21.76 17.2091 21.76 15V8.57895M16 1L21.76 8.57895M16 1V8.57895H21.76" stroke="#E9E9E9" stroke-width="0.8"/>
                    </svg> GS-4
                </li>
                <li class="p-[10px] cursor-pointer hover:bg-[#ECECEC] flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 23 20" fill="none" class="mr-[10px]">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.76 15C21.76 17.2091 19.9691 19 17.76 19H5C2.79086 19 1 17.2091 1 15V5C1 2.79086 2.79086 1 5 1H16V8.57895H21.76V15Z" fill="white"/>
                        <path d="M16 1L21.76 8.57895H16V1Z" fill="#8F93A3"/>
                        <path d="M16 1H5C2.79086 1 1 2.79086 1 5V15C1 17.2091 2.79086 19 5 19H17.76C19.9691 19 21.76 17.2091 21.76 15V8.57895M16 1L21.76 8.57895M16 1V8.57895H21.76" stroke="#E9E9E9" stroke-width="0.8"/>
                    </svg> Others
                </li>
            </ul>
        </div>
        <div class="w-4/6">
            <ul class="flex flex-wrap justify-between">
                <li class="relative rounded-sm text-[#000] border-[#E9E9E9] border-[1px] py-[10px] mb-4 w-[47%] cursor-pointer">
                    <div class="card-corner">
						<div class="card-corner-triangle"></div>
					</div>
                    <span class="text-ellipsis whitespace-nowrap overflow-hidden px-[20px] block">Labour</span></li>
                <li class="relative rounded-sm text-[#000] border-[#E9E9E9] border-[1px] py-[10px] mb-4 w-[47%] cursor-pointer">
                    <div class="card-corner">
						<div class="card-corner-triangle"></div>
					</div>
                    <span class="text-ellipsis whitespace-nowrap overflow-hidden px-[20px] block">Labour-1</span></li>
                <li class="relative rounded-sm text-[#000] border-[#E9E9E9] border-[1px] py-[10px] mb-4 w-[47%] cursor-pointer">
                    <div class="card-corner">
						<div class="card-corner-triangle"></div>
					</div>
                    <span class="text-ellipsis whitespace-nowrap overflow-hidden px-[20px] block">Banking and Fi....</span>
                </li>
            </ul>
        </div>
        
    </div>
    <!-- folder footer -->
    <div class="bg-[#E5EAF4] p-[20px]">
        <div class="flex justify-between space-x-4 text-sm items-center mb-[20px]">
            <p class="whitespace-nowrap text-[#040404]">Move to:</p>
            <input type="text" class="w-full rounded-sm h-[30px] border-[#D8D8D8]">
        </div>
        <div class="flex justify-end">
            <button class="py-[5px] px-[30px] mr-[15px] rounded-[4px] bg-transparent text-[#3362CC] border-2 border-[#3362CC] hover:text-white hover:bg-[#3362CC]">Cancel</button>
            <button class="py-[5px] px-[30px] rounded-[4px] bg-[#3362CC] text-white border-2 border-[#3362CC] hover:text-[#3362CC] hover:bg-transparent">Move</button>
        </div>
    </div> 
</div>

@endsection