function expand(item) {
    const x = document.querySelector(`#${item.id}`);
    const answer = x.nextElementSibling;
    if (answer.className === "answer-block") {
        answer.className = "answer-block-expand";
    } else {
        answer.className = "answer-block";
    }
}