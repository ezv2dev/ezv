/**
 * @description Change Home page slider's arrows active status
 */

// JS Slider Restaurant
function updateSliderArrowsStatus2(
    cardsContainer,
    containerWidth,
    cardCount,
    cardWidth
) {
    if (
        $(cardsContainer).scrollLeft() + containerWidth <
        cardCount * cardWidth + 15
    ) {
        $("#slide-right-container2").addClass("active");
    } else {
        $("#slide-right-container2").removeClass("active");
    }
    if ($(cardsContainer).scrollLeft() > 0) {
        $("#slide-left-container2").addClass("active");
    } else {
        $("#slide-left-container2").removeClass("active");
    }
}

$(function () {
    const mediaQuery = window.matchMedia('(max-width: 1280px)')

    if (mediaQuery.matches){
        // Scroll products' slider left/right
    let div = $("#cards-container2");
    let cardCount = $(div)
        .find(".cards2")
        .children(".card2").length;
    let speed = 200;
    let containerWidth = $(".containerSlider2").width();
    let cardWidth = 210;

    updateSliderArrowsStatus2(div, containerWidth, cardCount, cardWidth);

    //Remove scrollbars
    $("#slide-right-container2").click(function (e) {
        if ($(div).scrollLeft() + containerWidth < cardCount * cardWidth) {
            $(div).animate({
                scrollLeft: $(div).scrollLeft() + cardWidth
            }, {
                duration: speed,
                complete: function () {
                    setTimeout(
                        updateSliderArrowsStatus2(
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
        updateSliderArrowsStatus2(div, containerWidth, cardCount, cardWidth);
    });
    $("#slide-left-container2").click(function (e) {
        if ($(div).scrollLeft() + containerWidth > containerWidth) {
            $(div).animate({
                scrollLeft: "-=" + cardWidth
            }, {
                duration: speed,
                complete: function () {
                    setTimeout(
                        updateSliderArrowsStatus2(
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
        updateSliderArrowsStatus2(div, containerWidth, cardCount, cardWidth);
    });

    // If resize action ocurred then update the container width value
    $(window).resize(function () {
        try {
            containerWidth = $("#cards-container2").width();
            updateSliderArrowsStatus2(div, containerWidth, cardCount, cardWidth);
        } catch (error) {
            console.log(
                `Error occured while trying to get updated slider container width: 
            ${error}`
            );
        }
    });
    } else {
        // Scroll products' slider left/right
    let div = $("#cards-container2");
    let cardCount = $(div)
        .find(".cards2")
        .children(".card2").length;
    let speed = 200;
    let containerWidth = $(".containerSlider2").width();
    let cardWidth = 215;

    updateSliderArrowsStatus2(div, containerWidth, cardCount, cardWidth);

    //Remove scrollbars
    $("#slide-right-container2").click(function (e) {
        if ($(div).scrollLeft() + containerWidth < cardCount * cardWidth) {
            $(div).animate({
                scrollLeft: $(div).scrollLeft() + cardWidth
            }, {
                duration: speed,
                complete: function () {
                    setTimeout(
                        updateSliderArrowsStatus2(
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
        updateSliderArrowsStatus2(div, containerWidth, cardCount, cardWidth);
    });
    $("#slide-left-container2").click(function (e) {
        if ($(div).scrollLeft() + containerWidth > containerWidth) {
            $(div).animate({
                scrollLeft: "-=" + cardWidth
            }, {
                duration: speed,
                complete: function () {
                    setTimeout(
                        updateSliderArrowsStatus2(
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
        updateSliderArrowsStatus2(div, containerWidth, cardCount, cardWidth);
    });

    // If resize action ocurred then update the container width value
    $(window).resize(function () {
        try {
            containerWidth = $("#cards-container2").width();
            updateSliderArrowsStatus2(div, containerWidth, cardCount, cardWidth);
        } catch (error) {
            console.log(
                `Error occured while trying to get updated slider container width: 
            ${error}`
            );
        }
    });
    }
});