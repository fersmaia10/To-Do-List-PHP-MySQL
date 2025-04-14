function done(button) {
    let text_task = document.getElementById("task_item");
    text_task.classList.add("done_task");
    button.remove(); // Remove o botão clicado
}
