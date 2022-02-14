function formatDate(item) {
    let theDate = new Date(item);
    return theDate.toLocaleString(lang, {day: '2-digit', month: '2-digit', year: 'numeric', timeZone: 'UTC'});
}

function getFilesList(searchTerm, language, companyID, iconFile) {
    var url = "https://apicatalog.mziq.com/filemanager/elastic/company/" + companyID + "/search-documents";
    $.get(
        url,
        {
            term: searchTerm,
            language: language,
            size: 100,
        },
        function (response) {
            var data = response.data;

            if (!data.length == 0) {
                var files = [];
                for (let i = 0; i < data.length; i++) {
                    if (data[i].language === language) {
                        var name = data[i].filename;
                        var shortName = data[i].filename;
                        var date = formatDate(data[i].file_published_date);
                        var url = data[i].permalink;

                        if (shortName.length > 40) {
                            shortName = shortName.substr(0, 40) + "...";
                        }

                        files.push({
                            name: name,
                            shortName: shortName,
                            date: date,
                            file_url: url,
                        });
                    }
                }

                const filesFiltered = files.sort(function (a, b) {
                    // Turn your strings into dates, and then subtract them
                    // to get a value that is either negative, positive, or zero.
                    return (new Date(b.date.split("/").reverse()) - new Date(a.date.split("/").reverse()));
                });

                for (let i = 0; i < filesFiltered.length; i++) {
                    var tr = document.createElement("tr");

                    var item = `
                        <td class="icon">
                            <a href="${filesFiltered[i].file_url}" title="${filesFiltered[i].name}" target="_blank">
                                <img src="${iconFile}" />
                            </a
                        </td>
                        <td class="title">
                            <span class="fileName">${filesFiltered[i].shortName}</span><br>
                            <span class="date">${filesFiltered[i].date}</span>
                        </td>
                        <td class="download"><a href="${filesFiltered[i].file_url}" target="_blank"></a></td>
                    `;

                    tr.innerHTML = item;
                    document.querySelector(".searchFiles tbody").appendChild(tr);
                    loading.classList.add('finished');
                }
                pagination(".iqFiles");
            } else {
                $(".searchFiles.files-prev").hide();
                $(".searchFiles.files-next").hide();
                var tr = document.createElement("tr");

                if (lang == "en") {
                    var noFileMessage = "No files found.";
                } else {
                    var noFileMessage = "Nenhum arquivo encontrado.";
                }

                var item = `<td class="searchFiles__date" colspan="3">${noFileMessage}</td>`;
                tr.innerHTML = item;

                document.querySelector(".searchFiles tbody").appendChild(tr);
                loading.classList.add('finished');
            }
        }
    );
}
// Paginação
function pagination(seletor) {
    var length = $(seletor + " tbody").children("tr").length;

    if (length > 5) {
        $(seletor + " tbody tr:gt(4)").hide();
        $(seletor + " .files-prev").click(function () {
            var first = $(seletor + " tbody").children("tr:visible:first");
            first.prevAll(":lt(5)").show();
            first.prev().nextAll().hide();
            checkPaginationNumber();
        });

        $(seletor + " .files-next").click(function () {
            var last = $(seletor + " tbody").children("tr:visible:last");
            last.nextAll(":lt(5)").show();
            last.next().prevAll().hide();
            checkPaginationNumber();
        });

        function checkPaginationNumber() {
            var firstTr = $(seletor + " tbody").children("tr:first");
            var lastTr = $(seletor + " tbody").children("tr:last");
            if (!firstTr.css("display") == "block" || !firstTr.is(":visible")) {
                $(seletor + " .files-prev").attr("disabled", false);
            } else {
                $(seletor + " .files-prev").attr("disabled", true);
            }

            if (!lastTr.css("display") == "block" || !lastTr.is(":visible")) {
                $(seletor + " .files-next").attr("disabled", false);
            } else {
                $(seletor + " .files-next").attr("disabled", true);
            }
        }
    } else {
        $(seletor + " .files-next").hide();
        $(seletor + " .files-prev").hide();
    }
}

pagination(".wpContents");
