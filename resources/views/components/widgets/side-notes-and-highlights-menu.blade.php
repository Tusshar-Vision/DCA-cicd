<div class="fixed top-1/2 right-0 transform -translate-y-1/2 bg-visionBlue shadow-lg">
    <ul class="flex flex-col justify-between items-center list-none">
        <button @click="{{ Auth::check() ? 'isHighlightsOpen = true' : 'isLoginFormOpen=true' }}"
            class="flex items-center p-4">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 0C19.5523 0 20 0.44772 20 1V15C20 15.5523 19.5523 16 19 16H4.455L0 19.5V1C0 0.44772 0.44772 0 1 0H19ZM18 2H2V15.385L3.76333 14H18V2ZM8.5153 4.4116L8.9616 5.1004C7.29402 6.0027 7.32317 7.4519 7.32317 7.7645C7.47827 7.7431 7.64107 7.7403 7.80236 7.7553C8.7045 7.8389 9.4156 8.5795 9.4156 9.5C9.4156 10.4665 8.6321 11.25 7.66558 11.25C7.12905 11.25 6.61598 11.0048 6.29171 10.6605C5.77658 10.1137 5.5 9.5 5.5 8.5052C5.5 6.75543 6.72825 5.18684 8.5153 4.4116ZM13.5153 4.4116L13.9616 5.1004C12.294 6.0027 12.3232 7.4519 12.3232 7.7645C12.4783 7.7431 12.6411 7.7403 12.8024 7.7553C13.7045 7.8389 14.4156 8.5795 14.4156 9.5C14.4156 10.4665 13.6321 11.25 12.6656 11.25C12.1291 11.25 11.616 11.0048 11.2917 10.6605C10.7766 10.1137 10.5 9.5 10.5 8.5052C10.5 6.75543 11.7283 5.18684 13.5153 4.4116Z"
                    fill="white" />
            </svg>
        </button>

        <svg width="42" height="2" viewBox="0 0 42 2" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M42 1L0 1" stroke="white" />
        </svg>

        <button @click='isNoteOpen=true' class="flex p-4 items-center">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.41421 15.89L16.5563 5.74786L15.1421 4.33365L5 14.4758V15.89H6.41421ZM7.24264 17.89H3V13.6474L14.435 2.21233C14.8256 1.8218 15.4587 1.8218 15.8492 2.21233L18.6777 5.04075C19.0682 5.43128 19.0682 6.06444 18.6777 6.45497L7.24264 17.89ZM3 19.89H21V21.89H3V19.89Z"
                    fill="white" />
            </svg>
        </button>
    </ul>
</div>
