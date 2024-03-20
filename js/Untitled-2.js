var sdispositioncode = "7";
if (parseInt(sdispositioncode) != 7) {
    sdispositioncode = 7 + "";
}

switch (sdispositioncode) {
    case "0":
        ejecutarDispositionCode(sdispositioncode);
        break;

    default:
        break;
}

function ejecutarDispositionCode(sdispositioncode = "0") {
    if (fingestion < 10) {
        sdispositioncode = "7";
        return;
    } else if (fingestion >= 10) {
        sdispositioncode = "7";
        return;
    } else {
        sdispositioncode = "7";
        return;
    }
    return;
}