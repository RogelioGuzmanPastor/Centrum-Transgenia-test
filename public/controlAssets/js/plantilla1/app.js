$(document).ready(function(){

        var gridViewScroll = new GridViewScroll({
            elementID : "tabla", // Target element id
            width : 1200, // Integer or String(Percentage)
            height : 800, // Integer or String(Percentage)
            freezeColumn : false, // Boolean
            freezeFooter : false, // Boolean
            freezeColumnCssClass : "thead", // String
            freezeFooterCssClass : "thead", // String
            freezeHeaderRowCount : 1, // Integer
            freezeColumnCount : 1, // Integer
            // onscroll: function (scrollTop, scrollLeft) // onscroll event callback
        });
        gridViewScroll.enhance();


})