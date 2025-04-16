function done(button) {
    if (!button.classList.contains("button_done"))
        return;

    let text_task = button.closest("li")
    let task_item = text_task.querySelector(".task_item")


    task_item.classList.add("task_done")
    button.remove(); // Remove o botão clicado
}
