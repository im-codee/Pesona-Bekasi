$(document).ready(function() {
    $('.select2').select2({
        width: '100%',
        templateResult: formatOption,
        templateSelection: formatOption
    });

    function formatOption(option) {
        if (!option.id) return option.text;

        var iconName = $(option.element).data('icon');
        if (!iconName) return option.text;

        var iconHtml;
        if (iconName.includes(" ")) {
            iconHtml = `<i class="${iconName}" style="font-size: 18px;"></i>`;
        } else {
            iconHtml = `<span class="material-symbols-outlined" style="font-size: 20px;">${iconName}</span>`;
        }

        return $(`
            <span style="display: inline-flex; align-items: center;">
                ${iconHtml}
                <span style="margin-left: 8px;">${option.text}</span>
            </span>
        `);
    }
});



