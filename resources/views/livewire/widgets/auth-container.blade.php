<div>
    <livewire:dynamic-component :is="$component" wire:key="{{ \Carbon\Carbon::now() }}" />
</div>
<script>
    // restrict label animation
    document.addEventListener('livewire:init', () => {

        let inputFields = document.querySelectorAll('input');

        inputFields.forEach(function(input) {
            input.addEventListener('focus', function() {
                animateLabelOnFocus(input);
            });

            input.addEventListener('blur', function() {
                animateLabelOnFocusOut(input);
            });
        });

        Livewire.hook('morph.updated', ({ el, component }) => {
            inputFields.forEach(function (input) {
                animateLabelOnFocus(input);
                animateLabelOnFocusOut(input);
            });
        });
    });

    // show hide function
    function showPassword(targetID) {
        const x = document.getElementById(targetID);
        const img = document.querySelector('.eye');
        if (x.type === "password") {
            x.type = "text";
            img.style.opacity = "0.5";
        } else {
            x.type = "password";
            img.style.opacity = "1";
        }
    }

    function animateLabelOnFocus(input) {
        if (input !== null && input.nextElementSibling !== null) {
            input.nextElementSibling.style.top = '-5px';
            input.nextElementSibling.style.fontSize = '11px';
            input.nextElementSibling.style.color = '#3362CC';
            input.nextElementSibling.style.zIndex = '1';
        }
    }

    function animateLabelOnFocusOut(input) {
        if (input !== null && input.value === '' && input.nextElementSibling !== null) {
            input.nextElementSibling.style.top = '';
            input.nextElementSibling.style.fontSize = '';
            input.nextElementSibling.style.color = '';
            input.nextElementSibling.style.zIndex = '0';
        }
    }
</script>
