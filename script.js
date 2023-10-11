document.addEventListener("DOMContentLoaded", function () {
    const personalDataTab = document.getElementById("personalDataTab");
    const orderHistoryTab = document.getElementById("orderHistoryTab");
    const personalDataContent = document.getElementById("personalDataContent");
    const orderHistoryContent = document.getElementById("orderHistoryContent");

    personalDataTab.addEventListener("click", function () {
        personalDataContent.style.display = "block";
        orderHistoryContent.style.display = "none";
    });

    orderHistoryTab.addEventListener("click", function () {
        personalDataContent.style.display = "none";
        orderHistoryContent.style.display = "block";
    });

    personalDataTab.click();
});
