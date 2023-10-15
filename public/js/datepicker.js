$(function () {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const startDate = urlParams.get("startDate");
    const endDate = urlParams.get("endDate");
    var start =
        startDate !== null && startDate !== ""
            ? moment(startDate)
            : moment().subtract(29, "days");
    var end = endDate !== null && endDate !== "" ? moment(endDate) : moment();

    function cb(start, end) {
        $("#reportrange .range").val(
            start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
        );
        $("[name=startDate]").val(start.format("YYYY-MM-DD"));
        $("[name=endDate]").val(end.format("YYYY-MM-DD"));
    }

    $(".clear-date").click(() => {
        $(".range").val("");
        $("[name=startDate]").val("");
        $("[name=endDate]").val("");
    });

    $("#reportrange .calendar").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                "Hari Ini": [moment(), moment()],
                Kemarin: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "7 Hari Kemarin": [moment().subtract(6, "days"), moment()],
                "30 Hari Kemarin": [moment().subtract(29, "days"), moment()],
                "Bulan Ini": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Bulan Lalu": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
            alwaysShowCalendars: true,
            opens: "left",
        },
        cb
    );

    cb(start, end);
});
