<div>
    <livewire:dynamic-component :is="$component" wire:key="{{ \Carbon\Carbon::now() }}" />
</div>
@script
    <script>
        window.fields = ['otp_first', 'otp_sec', 'otp_third', 'otp_fourth', 'otp_fifth', 'otp_sixth'];

        // Handle input events for OTP fields
        window.handleInput = function(index, event) {
            // Restrict input to a single digit
            event.target.value = event.target.value.slice(-1);

            // If a digit is entered, move focus to the next input
            if (event.target.value && index < window.fields.length - 1) {
                document.getElementById(window.fields[index + 1]).focus();
            }
        }

        window.handleBackspace = function(index, event) {
            if (event.key === 'Backspace' && index > 0) {
                event.preventDefault();
                event.target.value = '';
                document.getElementById(window.fields[index - 1]).focus();
            }
        }
    </script>
@endscript
