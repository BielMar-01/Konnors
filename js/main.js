/*--------------------------------------------------------------
## Englobe tables on table-responsive
--------------------------------------------------------------*/
document.querySelectorAll(".wpContent table:not(.custom-table)").forEach(function(table){
    table.outerHTML = '<div class="table-responsive">'+ table.outerHTML +'</div>';
});
/*--------------------------------------------------------------
## Remove href from empty links
--------------------------------------------------------------*/
document.querySelectorAll("nav a[href='#']").forEach(function(link){
    link.removeAttribute("href");
});
/*--------------------------------------------------------------
## Accordion
--------------------------------------------------------------*/
document.querySelectorAll(".accordion__item__header").forEach(function(e){
    e.addEventListener("click", function(event){
        event.target.classList.toggle("active");
    });
});

/*--------------------------------------------------------------
## Toggle mobile sub-menu
--------------------------------------------------------------*/
document.querySelectorAll(".primary-menu > li > a").forEach(function(menuItem){
    menuItem.addEventListener("click", function(){
        this.classList.toggle("active");
    });
});

/*--------------------------------------------------------------
## Focus search on click
--------------------------------------------------------------*/
const searchField = document.getElementById('search');
document.getElementById('searchToggle').addEventListener('change', function(e){
    if(this.checked) {
        searchField.focus();
    }
});

/*--------------------------------------------------------------
## Fix footer on the bottom
--------------------------------------------------------------*/
const theFooter = document.querySelector("footer");

// Margin betweem the footer and the wpContent
const margin = 32;

function setFooterFixed(){
    if(document.body.clientHeight < (window.innerHeight - theFooter.clientHeight + margin)){
        theFooter.style.position = "fixed";
        theFooter.style.bottom = 0;
        theFooter.style.left = 0;
    }else {
        theFooter.style.position = "relative";
    }
}

//setInterval(setFooterFixed, 100);


/*--------------------------------------------------------------
## Close menus on press Esc
--------------------------------------------------------------*/
window.addEventListener("keydown", function(e){
    if(e.key === "Escape"){
        document.querySelectorAll("input[type=checkbox].hiddenToggle:checked").forEach(function(hiddenToggle){
            hiddenToggle.click();
        });
    }
});

/*--------------------------------------------------------------
## Numbers growing effect
--------------------------------------------------------------*/
/**
 * 
 * @param {HTMLElement} elm
 */
function isVisible(elm) {
    var rect = elm.getBoundingClientRect();
    var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
    
    return (rect.top < (viewHeight / 2) && rect.top > (-rect.height - 200));
}

document.querySelectorAll(".imVisible").forEach(function(e){
    window.addEventListener("scroll", function(){
        if(isVisible(e)){
            e.classList.add("isVisible");
        }else {
            e.classList.remove("isVisible");
        }
    });
});

const growyItems = document.querySelectorAll(".growThis");
const degrees = 90;
growyItems.forEach(function (item) {
    let targetValue = item.getAttribute("value");
    let precision = {
        maximumFractionDigits: targetValue.split('.').length < 2 ? 0 : targetValue.length - targetValue.indexOf('.') - 1
    };

    if (item.innerHTML != parseFloat(targetValue).toLocaleString(lang, precision)) {
        const step = 1;
        let progress = 0;

        var growingFunction = setInterval(function () {
            if (isVisible(item) && !item.classList.contains("growing")) {
                item.classList.add("growing");
            }

            if (item.classList.contains("growing")) {
                if (progress < step) {
                    let smoothProgress = Math.sqrt(1 - Math.pow(progress - 1, 2));
                    item.innerHTML = (parseFloat(targetValue) * (smoothProgress)).toLocaleString(lang, precision);
                    progress += progress + .005 < step ? .005 : step - progress;
                } else if(progress >= step){
                    progress = step;
                    let smoothProgress = Math.sqrt(1 - Math.pow(progress - 1, 2));
                    item.innerHTML = (parseFloat(targetValue) * (smoothProgress)).toLocaleString(lang, precision);

                    item.classList.remove("growing");
                    clearInterval(growingFunction);
                }
            }
        }, 1000 / 60);
    }
});