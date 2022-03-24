function addTaskAction() {
    const addTask = document.getElementById("add-task");
    const close = document.getElementById("close");
    const popup = document.getElementById("popup");
    const addTaskPopup = document.getElementById("add-task-popup");
    addTask.onclick = () => {
        popup.style.display = "flex";
        addTaskPopup.style.display = "flex";
    };

    close.onclick = () => {
        popup.style.display = "none";
        addTaskPopup.style.display = "none";
    };
}

function main() {
    addTaskAction();
}

main();
