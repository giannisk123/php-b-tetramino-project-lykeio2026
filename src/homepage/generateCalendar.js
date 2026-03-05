const startYear = 2025;
const endYear = startYear + 1;
import { GIORTES_KAI_ARGIES } from "./GIORTES_KAI_ARGIES.js";

const monthsOrder = [
    { y: startYear, m: 8 },
    { y: startYear, m: 9 },
    { y: startYear, m: 10 },
    { y: startYear, m: 11 },
    { y: endYear, m: 0 },
    { y: endYear, m: 1 },
    { y: endYear, m: 2 },
    { y: endYear, m: 3 },
    { y: endYear, m: 4 },
    { y: endYear, m: 5 },
    { y: endYear, m: 6 },
    { y: endYear, m: 7 }
];
const monthNames = [
    "ΙΑΝΟΥΑΡΙΟΣ", "ΦΕΒΡΟΥΑΡΙΟΣ", "ΜΑΡΤΙΟΣ", "ΑΠΡΙΛΙΟΣ",
    "ΜΑΪΟΣ", "ΙΟΥΝΙΟΣ", "ΙΟΥΛΙΟΣ", "ΑΥΓΟΥΣΤΟΣ",
    "ΣΕΠΤΕΜΒΡΙΟΣ", "ΟΚΤΩΒΡΙΟΣ", "ΝΟΕΜΒΡΙΟΣ", "ΔΕΚΕΜΒΡΙΟΣ"
];
const weekdayNames = ["ΔΕΥ.", "ΤΡ.", "ΤΕΤ.", "ΠΕ.", "ΠΑΡ.", "ΣΑΒ.", "ΚΥΡ."];
const container = document.getElementById("calendarContainer");

const urlparams = new URLSearchParams(window.location.search);
const completedNote = urlparams.get("saved")

if (completedNote == 1) {
    const feedback = document.getElementById("completedNote");

    feedback.textContent = "Το σημείωμα αποθηκεύτηκε.";
}

console.log(completedNote);

for (let row = 0; row < 3; row++) {

    const table = document.createElement("table");
    table.className = "calendar";

    // Month titles row
    const titleRow = document.createElement("tr");
    
    titleRow.appendChild(document.createElement("th")); // empty corner

    for (let col = 0; col < 4; col++) {
        const monthObj = monthsOrder[row * 4 + col];
        const monthName = monthNames[monthObj.m]
        const th = document.createElement("th");
        th.colSpan = 6;
        th.className = "month-title";
        th.textContent =
        monthName  + " " + monthObj.y;
        titleRow.appendChild(th);
    }

    table.appendChild(titleRow);

    // Prepare month data
    const monthData = [];

    for (let col = 0; col < 4; col++) {
        const { y, m } = monthsOrder[row * 4 + col];

        const firstDay = new Date(y, m, 1);
        let startDay = firstDay.getDay();
        startDay = (startDay === 0) ? 6 : startDay - 1;

        const daysInMonth =
            new Date(y, m + 1, 0).getDate();

        const matrix = Array.from({ length: 7 },
            () => Array(6).fill(""));

        let day = 1;
        for (let week = 0; week < 6; week++) {
            for (let d = 0; d < 7; d++) {
                if ((week === 0 && d < startDay) ||
                    day > daysInMonth) continue;
                matrix[d][week] = day++;
            }
        }

        monthData.push(matrix);
    }

    // Weekday rows
    for (let d = 0; d < 7; d++) {

        const tr = document.createElement("tr");

        const weekdayCell = document.createElement("td");

        weekdayCell.textContent = weekdayNames[d];
        weekdayCell.className = "weekday";

        tr.appendChild(weekdayCell);

        for (let col = 0; col < 4; col++) {
            for (let week = 0; week < 6; week++) {
                const td = document.createElement("td");
                const imeraTouMina = monthData[col][d][week]
                
                const monthObj = monthsOrder[row * 4 + col];
                const monthNumber = monthObj.m;

                const monthName = monthNames[monthObj.m];
                
                const argiesRegistry = GIORTES_KAI_ARGIES[String(endYear)][monthName];

                if (argiesRegistry.ΑΡΓΙΕΣ.indexOf(imeraTouMina) != -1) {
                    td.style = "background-color: rgb(255, 0, 0)";
                } else if (argiesRegistry.ΓΙΟΡΤΕΣ.indexOf(imeraTouMina) != -1) {
                    td.style = "background-color: rgb(255, 255, 0)";
                }
                
                if (imeraTouMina != undefined) {
                    const textAndLinkBox = document.createElement("a");

                    textAndLinkBox.textContent = imeraTouMina;
                    textAndLinkBox.href = `./src/notePage/notes.php?day=${imeraTouMina}&month=${monthNumber + 1}&year=${monthObj.y}`;
                    textAndLinkBox.className = "dayCell";

                    td.appendChild(textAndLinkBox);
                }
               
                tr.appendChild(td);
            }
        }

        table.appendChild(tr);
    }

    container.appendChild(table);
}
