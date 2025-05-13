let entry_task = document.getElementById('entry_task');
let form = document.getElementById('form_task');

form.addEventListener('submit', function (event) {
    if (entry_task.value.length <= 3) {
        window.alert('Quantidade de caracteres inválida. Digite mais de 3!');
        /*verificação de envio do form*/
        event.preventDefault();
    }
});




function done(button) {
    if (!button.classList.contains("button_done"))
        return;

    let text_task = button.closest("li")
    let task_item = text_task.querySelector(".task_item")


    task_item.classList.add("task_done")
    button.remove(); // Remove o botão clicado
}
