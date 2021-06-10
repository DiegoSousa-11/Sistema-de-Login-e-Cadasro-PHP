var inputs = document.querySelectorAll('.input');

for(var i = 0; i < inputs.length; i++)
{
    inputs[i].addEventListener('focus', (e) => {
        e.target.removeAttribute("placeholder");
        var el = e.target.parentNode.querySelector('.text_input');
        el.classList.add('text_input_active');
    });

    inputs[i].addEventListener('blur', (e) => {
        if(e.target.value.length < 1)
        {
            var el = e.target.parentNode.querySelector('.text_input');
            el.classList.remove('text_input_active');
            e.target.setAttribute("placeholder", e.target.getAttribute("rel"));
        }
    }, false);
}