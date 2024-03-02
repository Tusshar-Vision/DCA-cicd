<div class="flex flex-col md:flex-row text-white items-center justify-between">
    <div class="text-visionLineGray flex space-x-3 items-center text-sm">
        <p>Posted <strong>{{ $createdAt->format('d M Y')  }}</strong></p>

        @if ( $updatedAt >= $createdAt  )
            <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.64 12.672C6.4 11.296 5.424 9.568 3.568 8.176C2.656 7.488 1.728 7.04 0.816 6.848V6.176C2.624 5.744 4.4 4.528 5.536 2.88C6.112 2.048 6.48 1.232 6.64 0.384H7.312C7.584 2 8.832 3.792 10.528 4.992C11.36 5.584 12.224 5.984 13.104 6.176V6.848C11.328 7.216 9.264 8.8 8.24 10.416C7.728 11.232 7.424 11.984 7.312 12.672H6.64Z" fill="#8F93A3"/>
            </svg>

            <p>Updated <strong>{{ $updatedAt->format('d M Y')  }}</strong></p>
        @endif
    </div>
</div>
