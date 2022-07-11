function updateSliderArrowsStatus3(
    cardsContainer,
    containerWidth,
    cardCount,
    cardWidth
) {
    if (
        $(cardsContainer).scrollLeft() + containerWidth <
        cardCount * cardWidth + 15
    ) {
        $("#slide-right-container3").addClass("active");
    } else {
        $("#slide-right-container3").removeClass("active");
    }
    if ($(cardsContainer).scrollLeft() > 0) {
        $("#slide-left-container3").addClass("active");
    } else {
        $("#slide-left-container3").removeClass("active");
    }
}

$(function () {
    // Scroll products' slider left/right
    let div = $("#cards-container3");
    let cardCount = $(div)
        .find(".cards3")
        .children(".card3").length;
    let speed = 300;
    let containerWidth = $(".containerSlider3").width();
    let cardWidth = 90;

    updateSliderArrowsStatus3(div, containerWidth, cardCount, cardWidth);

    //Remove scrollbars
    $("#slide-right-container3").click(function (e) {
        if ($(div).scrollLeft() + containerWidth < cardCount * cardWidth) {
            $(div).animate({
                scrollLeft: $(div).scrollLeft() + cardWidth
            }, {
                duration: speed,
                complete: function () {
                    setTimeout(
                        updateSliderArrowsStatus3(
                            div,
                            containerWidth,
                            cardCount,
                            cardWidth
                        ),
                        1005
                    );
                }
            });
        }
        updateSliderArrowsStatus3(div, containerWidth, cardCount, cardWidth);
    });
    $("#slide-left-container3").click(function (e) {
        if ($(div).scrollLeft() + containerWidth > containerWidth) {
            $(div).animate({
                scrollLeft: "-=" + cardWidth
            }, {
                duration: speed,
                complete: function () {
                    setTimeout(
                        updateSliderArrowsStatus3(
                            div,
                            containerWidth,
                            cardCount,
                            cardWidth
                        ),
                        1005
                    );
                }
            });
        }
        updateSliderArrowsStatus3(div, containerWidth, cardCount, cardWidth);
    });

    // If resize action ocurred then update the container width value
    $(window).resize(function () {
        try {
            containerWidth = $("#cards-container3").width();
            updateSliderArrowsStatus3(div, containerWidth, cardCount, cardWidth);
        } catch (error) {
            console.log(
                `Error occured while trying to get updated slider container width: 
            ${error}`
            );
        }
    });
});