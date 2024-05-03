<script>
    const dropDownParent = document.querySelectorAll(".dropdown-nav-parent");
    dropDownParent.forEach((elem, idx) => {
        const imgElem = elem.firstElementChild.lastElementChild;

        console.log(imgElem)
        console.log()
        imgElem.onclick = () => {
            for (let i = 0; i < dropDownParent.length; i++) {
                const dropDownItemElem = document.querySelectorAll(".dropdown-nav-items-parent")[i];
                if (i === idx) {
                    if (dropDownItemElem.style.height === "0px" || dropDownItemElem.style.height === "") {
                        dropDownItemElem.style.height = "75px";
                        imgElem.style.transform = "rotate(180deg)"
                    } else {
                        imgElem.style.transform = "rotate(0)"
                        dropDownItemElem.style.height = "0px";
                    }
                } else {
                    imgElem.style.transform = "rotate(0)"
                    dropDownItemElem.style.height = "0";
                }
                if (dropDownItemElem.style.height !== "0px" || dropDownItemElem.style.height !== "") {
                    const items = document.querySelectorAll(".items-dropdown")[i];
                    for (let i = 0; i < items.children.length; i++) {
                        const item = items.children.item(i);
                        item.onclick = () => {
                            imgElem.style.transform = "rotate(0)"
                            dropDownItemElem.style.height = "0px";
                            let timeOut = setTimeout(() => {
                                window.location.href = item.getAttribute("data-id-link")
                            }, 475)
                        }
                    }
                }
            }
        }
    })
    console.log("ASd")
</script>