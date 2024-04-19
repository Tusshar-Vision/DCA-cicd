<div class="flex justify-between mt-2 md:mt-0 space-x-2">
    <p>{{ (empty($readTime)) ? '5' : $readTime }} min read</p>

    <svg width="2" height="20" viewBox="0 0 2 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path opacity="0.5" d="M1 0V32" stroke="#8F93A3"/>
    </svg>

    <div class="flex items-center space-x-2">
        <button @click="fontSize -= 0.1; $el.dispatchEvent(new CustomEvent('font-size-changed', { detail: fontSize }))"
                :disabled="fontSize <= 0.8"
        >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="1" y="1" width="22" height="22" stroke="#8F93A3" stroke-width="2"/>
                <path d="M6.97869 17H5.34801L9.01207 6.81818H10.7869L14.451 17H12.8203L9.94176 8.66761H9.86222L6.97869 17ZM7.25213 13.0128H12.5419V14.3054H7.25213V13.0128ZM18.1822 8.83665V9.85582H13.6879V8.83665H18.1822Z" fill="#8F93A3"/>
            </svg>
        </button>

        <button @click="fontSize += 0.1; $el.dispatchEvent(new CustomEvent('font-size-changed', { detail: fontSize }))"
                :disabled="fontSize >= 2"
        >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="1" y="1" width="22" height="22" stroke="#8F93A3" stroke-width="2"/>
                <path d="M6.97869 17H5.34801L9.01207 6.81818H10.7869L14.451 17H12.8203L9.94176 8.66761H9.86222L6.97869 17ZM7.25213 13.0128H12.5419V14.3054H7.25213V13.0128ZM15.428 11.4964V7.19602H16.467V11.4964H15.428ZM13.6879 9.85582V8.83665H18.1822V9.85582H13.6879Z" fill="#8F93A3"/>
            </svg>
        </button>
    </div>
    {{-- <div class="flex space-x-2 text-visionLineGray items-center">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.9337 8.96494C16.426 5.03562 13.0675 2 9 2C4.58172 2 1 5.58172 1 10C1 11.8924 1.65707 13.6313 2.7555 15.0011C3.56351 16.0087 4.00033 17.1252 4.00025 18.3061L4 22H13L13.001 19H15C16.1046 19 17 18.1046 17 17V14.071L18.9593 13.2317C19.3025 13.0847 19.3324 12.7367 19.1842 12.5037L16.9337 8.96494ZM3 10C3 6.68629 5.68629 4 9 4C12.0243 4 14.5665 6.25141 14.9501 9.22118L15.0072 9.66262L16.5497 12.0881L15 12.7519V17H11.0017L11.0007 20H6.00013L6.00025 18.3063C6.00036 16.6672 5.40965 15.114 4.31578 13.7499C3.46818 12.6929 3 11.3849 3 10ZM21.1535 18.1024L19.4893 16.9929C20.4436 15.5642 21 13.8471 21 12.0001C21 10.153 20.4436 8.4359 19.4893 7.00722L21.1535 5.89771C22.32 7.64386 23 9.74254 23 12.0001C23 14.2576 22.32 16.3562 21.1535 18.1024Z" fill="#8F93A3"/>
        </svg>
        <p><strong>Read Aloud</strong></p>
    </div> --}}
</div>
