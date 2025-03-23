$(document).ready(function () {
    window.showToast = function (message, type = "success", duration = 3000) {
        let toastId = "toast-" + Date.now();

        let toastHtml = `
        <div id="${toastId}"  role="alert" class="alert alert-${type} alert-soft">
            <i data-lucide="info" class="text-secondary"></i>
            <div>
                <span>${message}</span>
            </div>
           <button onclick="$('#${toastId}').remove()" class="ml-auto"><i data-lucide="circle-x" class="text-secondary"></i></button>
        </div>
        `;

        $("#toast-container").append(toastHtml);

        setTimeout(function () {
            $("#" + toastId).fadeOut(500, function () {
                $(this).remove();
            });
        }, duration);
    };
});
