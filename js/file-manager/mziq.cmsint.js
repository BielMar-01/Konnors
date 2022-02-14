// Get Files grouped by Category
var getFilesGroupedByCategoryUrl = function (
    companyId,
    baseUrl,
    categoryId,
    year,
    lang,
    groupByQuarter
) {
    var targetUrl =
        baseUrl +"/api/c/" +
        companyId +
        "/c/" +
        categoryId +
        "/year/" +
        year +
        "/lang/" +
        lang;

    if (groupByQuarter === true) targetUrl += "?byQuarter=true";

    return targetUrl;
};

const getFilesTable = function(elementID){
    const theContainer = document.getElementById(elementID);

    if(!theContainer.classList.contains("table")){
        return theContainer.querySelector("table");
    }
    return theContainer;
}

/// Clear the tables
var clearTables = function (tables) {
    tables.forEach(function(table){
        document.getElementById(table).style.display = "none";
        
        var theTable = getFilesTable(table);
        theTable.innerHTML = "";
    });
};

var formatShortDate = function (item) {
    var formatedDate = moment(item.file_published_date, 'YYYYMMDD');
    console.log(lang)
    if (lang === 'pt-br') {
        return formatedDate.format('DD/MM/YYYY')
    }
    else {
        return formatedDate.format('MM/DD/YYYY')
    }
}

var orderPublishedDate = function (array) {
    return array.sort(function (a, b) {
        return (
            new Date(b.file_published_date) - new Date(a.file_published_date)
        );
    });
};

var loadCategories = function (infoCategories) {
    internalNames = [];
    infoCategories.forEach(function (info) {
        internalNames.push(info.internal_name);
    });

    return internalNames;
};

/// Return the Url to Retrieve years given a set of subcategories
var getCategoryYearsURL = function (companyId, baseUrl) {
    return (
        baseUrl +
        "/company/" +
        companyId +
        "/categoryInternalName/document/language/years"
    );
};

var getFilesByCategoriesUrl = function (companyId, baseUrl) {
    var targetUrl = baseUrl + "/company/" + companyId + "/filter/categories/year/meta";

    return targetUrl;
};

var getFilesByCategoriesAllYearsUrl = function (companyId, baseUrl) {
    var targetUrl = baseUrl + "/company/" + companyId + "/filter/categories/meta";

    return targetUrl;
};

//////////////////#########################################//////////////////

////////// Load Html Files

// Fill the table with datas
const fillHome = function (
    categories,
    files,
    year,
    tables
) {
    if(!files.length) return;
    //console.log(files)
    tables.map(function(table, i){
        let theTable = document.getElementById(table);
        if(!theTable.classList.contains("table")){
            theTable = theTable.querySelector("table");
        }

        theTable.createTBody();

        let category = categories[i];
        
        for(let i = 0; i < 3; i++){
            let file = files[i];

            if ((file.internal_name || file.category_internal_name) === category.internal_name) {
                var fileLink = (file.link_url || file.permalink);
                var row = [
                    '<td class="icone"><a href="'+ fileLink +'" target="_blank"><img src="'+ category.icon +'"/></a></td>',
                    '<td class="title"><span>'+ file.file_title +'</span><br><span class="date">'+ formatShortDate(file) +'</span></td>',
                    '<td class="download"><a href="'+ fileLink + '" target="_blank"></a></td>',
                ];

                theTable.insertRow().innerHTML = row.join("");
            }
        }

        document.getElementById(table).style.display = "";
    });
};

const fillInternal = function (
    categories,
    files,
    year,
    tables
) {
    //console.log("Fill Internal");
    tables.map(function(table, i){
        let theTable = document.getElementById(table);
        if(!theTable.classList.contains("table")){
            theTable = theTable.querySelector("table");
        }

        theTable.createTBody();

        let category = categories[i];
        
        let empty = true;
        files.forEach(function (file) {
            if ((file.internal_name || file.category_internal_name) === category.internal_name) {
                var fileLink = (file.link_url || file.permalink);
                var row = [
                    '<td class="icone"><a href="'+ fileLink +'" target="_blank"><img src="'+ category.icon +'"/></a></td>',
                    '<td class="title"><span>'+ file.file_title +'</span><br><span class="date">'+ formatShortDate(file) +'</span></td>',
                    //'<td class="copy"><button tabindex="-1" class="linkCopy" title="Copiar link." link="' + fileLink + '"><span>' + copied + '</span></button></td>',
                    '<td class="download"><a href="'+ fileLink + '" target="_blank"></a></td>',
                ];

                theTable.insertRow().innerHTML = row.join("");
                empty = false;
            }
        });

        if(!empty) document.getElementById(table).style.display = "";

        document.querySelectorAll(".linkCopy").forEach(function(item){
            data = item.getAttribute("link");
    
            item.addEventListener("click", function(e){
                item.classList.remove("done");
    
                const el = document.createElement('textarea');
                el.value = data;
                document.body.appendChild(el);
                el.select();
    
                document.execCommand('copy');
                document.body.removeChild(el);
    
                item.classList.add("done");
            })
        });
    });
};

/**
 * 
 * @param {Array<{title:String,internal_name:String,icon:String}>} categories 
 * @param {Array<iQFile>} files 
 * @param {String} year
 * @param {Array<String>} containers 
 */
 const fillFooterUpdates = function (
    categories,
    files,
    year,
    containers
) {
    containers.map(function(container, i){
        var theTable = document.getElementById(container);
        var category = categories[i];

        files = files.slice(0, 3);

        files.forEach(function (file) {
            var item = document.createElement("a");
            var itemIcon = document.createElement("i");
    
            item.classList.add("file");
            item.setAttribute("href", (file.link_url || file.permalink));
            item.setAttribute("target", "_blank");
            item.innerHTML = file.file_title;
    
            itemIcon.classList.add("icon");
            itemIcon.setAttribute("style", "background-image: url("+ category.icon +")");
    
            item.prepend(itemIcon);
    
            theTable.appendChild(item);
        });

        theTable.style.display = "";
    });
};

const fillResultsCenter = function (
    categories,
    files,
    year,
    tables
) {
    tables.map(function(table, i) {
        let theTable = getFilesTable(table);

        let tHead = theTable.createTHead().insertRow();
        let yearDigitsWithQuarter = i18nShortQuarter + year.toLocaleString().substring(2, 4);

        tHead.insertCell().outerHTML = '<th class="year">'+ year +'</th>';
        tHead.insertCell().outerHTML = "<th>1" + i18nShortQuarter +"</th>";
        tHead.insertCell().outerHTML = "<th>2" + i18nShortQuarter +"</th>";
        tHead.insertCell().outerHTML = "<th>3" + i18nShortQuarter +"</th>";
        tHead.insertCell().outerHTML = "<th>4" + i18nShortQuarter +"</th>";

        theTable.createTBody();

        categories.forEach(function (category) {
            var theRow = theTable.tBodies[0].insertRow();
            var firstCell = theRow.insertCell();
            firstCell.innerHTML = category.title;
            firstCell.classList.add("first", "titulo");

            for (var quarter = 1; quarter <= 4; quarter++) {
                var hasFind = false;
                files.forEach(function (file) {
                    if (
                        file.internal_name === category.internal_name &&
                        parseInt(file.file_quarter) === quarter
                    ) {
                        hasFind = true;
                        var fileLink = (file.link_url || file.permalink);
                        var newCell = theRow.insertCell();
                        newCell.classList.add("icone");
                        newCell.innerHTML = '<a href="'+ fileLink +'" target="_blank">'+
                                                '<img src="'+ category.icon +'"/>'+
                                            '</a>';
                    }
                });
                if (!hasFind){
                    var newCell = theRow.insertCell();
                    newCell.classList.add("icone","off");
                    newCell.innerHTML = '<img src="'+ category.icon +'"/>';
                }
            }
        });

        document.getElementById(table).style.display = "";
    });
};

///////////////////////////////////////////////////////////////
/// Retrieve documents from the CMS
///////////////////////////////////////////////////////////////
var mzcms = function (config) {
    this.config = config;
    
    //Event change on dropdown year
    this.yearsField = document.getElementById(this.config.yearsFieldId);
    var _this = this;

    /// Fills the Years dropdown and maps the change in selected year
    this.fillYears = function () {
        var getYearsUrl = getCategoryYearsURL(_this.config.companyId, _this.config.baseUrl);
        $.ajax({
            type: "POST",
            url: getYearsUrl,
            data: JSON.stringify({
                categoryInternalNames: loadCategories(_this.config.categories),
                language_code: _this.config.language,
            }),
            success: function (res) {
                if (res.success) {
                    _this.formatYearsField(res.data);
                } else {
                    //TO-DO: Implement Error Handler
                }
            },
            error: function (err) {
                //TO-DO: Implement Error Handler
            },
            contentType: "application/json",
            dataType: "json",
        });
    };

    //Get files on API by config options
    this.getFiles = function(year) {
        var url = "";
        var data = null;
        
        _this.startLoading();
        this.config.clearCallback(this.config.tables);

        if (_this.config.groupByQuarter) {
            url = getFilesGroupedByCategoryUrl(
                this.config.companyId,
                this.config.baseUrl,
                loadCategories(_this.config.categories),
                this.getSelectedYear(),
                _this.config.language,
                _this.config.getAllYears
            );
        } else if (_this.config.getAllYears) {
            url = getFilesByCategoriesAllYearsUrl(this.config.companyId, this.config.baseUrl);
            var data = {
                categoryInternalNames: loadCategories(_this.config.categories),
                language: _this.config.language,
                published: true,
            };
        } else {
            url = getFilesByCategoriesUrl(this.config.companyId, this.config.baseUrl);
        }

        if (data == null) {
            var data = {
                year: year,
                categories: loadCategories(_this.config.categories),
                language: _this.config.language,
                published: true,
            };
        }

        $.ajax({
            type: "POST",
            url: url,
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify(data), //data
            success: function (res) {
                if (res.success) {
                    _this.config.fillCallback(
                        _this.config.categories,
                        res.data.document_metas,
                        year,
                        _this.config.tables
                    );
                } else {
                    console.error("MZiQ request failed",res);
                }
                _this.stopLoading();
            }
        });
    };

    /// Formats the Years Field and select the first year
    this.formatYearsField = function (years) {
        console.log(_this.yearsField);

        if (years.length <= 0) {
            _this.yearsField.style.display = "none";
        } else {
            _this.yearsField.style.display = "";
        }

        _this.yearsField.innerHTML = "";
        years.map(function(year, i){
            let newOption = document.createElement("option");
            newOption.value = year;
            newOption.innerHTML = year;

            _this.yearsField.appendChild(newOption);

            if(i === 0) newOption.setAttribute("selected", "");
        });

        this.getFiles(years[0]);
    };

    /// Returns selected year
    this.getSelectedYear = function () {
        if (_this.config.getAllYears) {
            return -1;
        } else {
            return _this.yearsField.value;
        }
    };

    this.startLoading = function () {
        _this.config.loadingElement?.classList.remove("finished");
    }
    this.stopLoading = function () {
        _this.config.loadingElement?.classList.add("finished");
    }

    /// Initializes the component
    this.init = function () {
        if (_this.config.getAllYears) {
            _this.getFiles();
        } else {
            _this.fillYears();

            _this.yearsField?.addEventListener("change", function(e){
                console.log("years changed")
                _this.getFiles(e.target.value);
            });
        }
    };
};
