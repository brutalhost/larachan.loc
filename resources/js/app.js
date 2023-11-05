const toast = (string, status) => {
    const colors = {
        'success': 'darkslateblue',
        'invalid': 'orangered',
    }

    const color = colors[status] ?? colors['success'];

    Toastify({
        text: string,
        gravity: "bottom", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        duration: 3000,
        style: {
            background: color,
        },
    }).showToast();
}
