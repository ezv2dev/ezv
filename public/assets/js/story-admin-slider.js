function updateSliderArrowsStatus4(
    cardsContainer,
    containerWidth,
    cardCount,
    cardWidth
) {
    if (
        $(cardsContainer).scrollLeft() + containerWidth <
        cardCount * cardWidth + 15
    ) {
        $("#slide-right-container4").addClass("active");
    } else {
        $("#slide-right-container4").removeClass("active");
    }
    if ($(cardsContainer).scrollLeft() > 0) {
        $("#slide-left-container4").addClass("active");
    } else {
        $("#slide-left-container4").removeClass("active");
    }
}

function sliderRestaurant() {
    // Scroll products' slider left/right
    let div = $("#cards-container4");
    let cardCount = $(div).find(".cards4").children(".card4").length;
    let speed = 400;
    let containerWidth = $(".containerSlider4").width();
    let cardWidth = 90;

    updateSliderArrowsStatus4(div, containerWidth, cardCount, cardWidth);

    //Remove scrollbars
    $("#slide-right-container4").click(function (e) {
        if ($(div).scrollLeft() + containerWidth < cardCount * cardWidth) {
            $(div).animate(
                {
                    scrollLeft: $(div).scrollLeft() + cardWidth,
                },
                {
                    duration: speed,
                    complete: function () {
                        setTimeout(
                            updateSliderArrowsStatus4(
                                div,
                                containerWidth,
                                cardCount,
                                cardWidth
                            ),
                            1005
                        );
                    },
                }
            );
        }
        updateSliderArrowsStatus4(div, containerWidth, cardCount, cardWidth);
    });
    $("#slide-left-container4").click(function (e) {
        if ($(div).scrollLeft() + containerWidth > containerWidth) {
            $(div).animate(
                {
                    scrollLeft: "-=" + cardWidth,
                },
                {
                    duration: speed,
                    complete: function () {
                        setTimeout(
                            updateSliderArrowsStatus4(
                                div,
                                containerWidth,
                                cardCount,
                                cardWidth
                            ),
                            1005
                        );
                    },
                }
            );
        }
        updateSliderArrowsStatus4(div, containerWidth, cardCount, cardWidth);
    });

    // If resize action ocurred then update the container width value
    $(window).resize(function () {
        try {
            containerWidth = $("#cards-container4").width();
            updateSliderArrowsStatus4(
                div,
                containerWidth,
                cardCount,
                cardWidth
            );
        } catch (error) {
            console.log(
                `Error occured while trying to get updated slider container width:
            ${error}`
            );
        }
    });
}

sliderRestaurant();
