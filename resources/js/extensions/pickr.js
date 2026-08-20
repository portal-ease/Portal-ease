import Pickr from '@simonwep/pickr';
import '@simonwep/pickr/dist/themes/nano.min.css';

const brandingInput = document.getElementById('branding');
const colorPicker = document.getElementById('color-picker');

if (brandingInput && colorPicker) {
    const pickr = Pickr.create({
        el: colorPicker,
        theme: 'nano',

        default: brandingInput.value || '#3B82F6',

        components: {
            preview: true,
            hue: true,

            interaction: {
                input: true,
                clear: true,
                save: true,
            },
        },
    });

    // Set initial button color
    colorPicker.style.backgroundColor = brandingInput.value;

    // Open Pickr when clicking the HEX input
    brandingInput.addEventListener('click', () => {
        pickr.show();
    });

    // Open Pickr when clicking the color button
    colorPicker.addEventListener('click', () => {
        pickr.show();
    });

    // Update input after selecting a color
    pickr.on('save', (color) => {
        if (color) {
            const hex = color.toHEXA().toString();

            brandingInput.value = hex;
            colorPicker.style.backgroundColor = hex;
        }
    });
}
