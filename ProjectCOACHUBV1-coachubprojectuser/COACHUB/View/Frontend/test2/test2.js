function showTab(tabName) {
  const tabs = document.querySelectorAll(".tab-pane");
  tabs.forEach((tab) => {
    if (tab.id === tabName) {
      tab.classList.add("active");
    } else {
      tab.classList.remove("active");
    }
  });

  const tabLinks = document.querySelectorAll(".tab-link");
  tabLinks.forEach((link) => {
    if (link.textContent.toLowerCase() === tabName) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
}
