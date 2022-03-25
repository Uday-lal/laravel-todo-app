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

function editTaskAction() {
    const editBtns = document.getElementsByClassName("edit");
    const closeBtns = document.getElementsByClassName("close");
    for (let editBtn of editBtns) {
        editBtn.onclick = () => {
            const buttonId = editBtn.id;
            const editTask = document.getElementById("edit-task-" + buttonId);
            const editTaskPoup = document.getElementById(
                "edit-task-popup-" + buttonId
            );
            editTask.style.display = "flex";
            editTaskPoup.style.display = "flex";
        };
    }

    for (let closeBtn of closeBtns) {
        closeBtn.onclick = () => {
            const popups = document.getElementsByClassName("popups");
            const popup = document.getElementsByClassName("popup");
            for (let p of popups) {
                p.style.display = "none";
            }

            for (let pop of popup) {
                pop.style.display = "none";
            }
        };
    }
}

function main() {
    addTaskAction();
    editTaskAction();
}

main();
