<div class="vi-pdf-card">
    <div class="vi-card-header">
        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.9985 0C0.44749 0 0 0.44405 0 0.9918V19.0082C0 19.5447 0.44476 20 0.9934 20H17.0066C17.5551 20 18 19.5489 18 18.9925L17.9997 5L13 0H0.9985ZM7.5 5.5H9.5C9.5 7.98994 11.6436 10.6604 14.3162 11.5513L13.8586 13.49C10.7234 13.0421 7.4821 14.3804 4.5547 16.3321L3.3753 14.7191C4.46149 13.8502 5.50293 12.3757 6.27499 10.6534C7.0443 8.9373 7.5 7.07749 7.5 5.5ZM8.1 11.4716C8.3673 10.8752 8.6043 10.2563 8.8037 9.6285C9.2754 10.3531 9.8553 11.0182 10.5102 11.5953C9.5284 11.7711 8.5666 12.0596 7.6353 12.4276C7.8 12.1143 7.9551 11.7948 8.1 11.4716Z" fill="#FD2B44"/>
        </svg>
        <a href="{{ route($file->collection_name) }}" class="vi-category">{{ ucfirst($file->collection_name) }}</a>
    </div>
    <p class="vi-card-body-text">
        <span class="font-bold">[PDF]</span> {{ $file->name }}
    </p>
    <div class="vi-card-footer">
        <a href="{{ route('download', ['media' => $file]) }}" class="flex items-center vi-downloads-links downloads">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                <path d="M11 7H16L10 13L4 7H9V0H11V7ZM2 16H18V9H20V17C20 17.5523 19.5523 18 19 18H1C0.44772 18 0 17.5523 0 17V9H2V16Z" fill="#8F93A3"/>
            </svg>
            <span class="ml-2">Download</span>
        </a>
        <span class="vi-divider"></span>
        <a href="#" class="flex items-center vi-downloads-links source-file">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z" fill="#8F93A3"/>
            </svg>
            <span class="ml-2">View File</span>
        </a>
    </div>
</div>
