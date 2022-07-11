/**
 * @description Change Home page slider's arrows active status
 */

// JS Slider Restaurant
function updateSliderArrowsStatus(
    cardsContainer,
    containerWidth,
    cardCount,
    cardWidth
) {
    if (
        $(cardsContainer).scrollLeft() + containerWidth <
        cardCount * cardWidth + 15
    ) {
        $("#slide-right-container").addClass("active");
    } else {
        $("#slide-right-container").removeClass("active");
    }
    if ($(cardsContainer).scrollLeft() > 0) {
        $("#slide-left-container").addClass("active");
    } else {
        $("#slide-left-container").removeClass("active");
    }
}

$(function () {
    const mediaQuery = window.matchMedia('(max-width: 1280px)')

    if (mediaQuery.matches) {
        // Then trigger an alert
        // alert('Media Query Matched!')
        // Scroll products' slider left/right
        let div = $("#cards-container");
        let cardCount = $(div)
            .find(".cards")
            .children(".card").length;
        let speed = 200;
        let containerWidth = $(".containerSlider").width();
        let cardWidth = 210;

        updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);

        //Remove scrollbars
        $("#slide-right-container").click(function (e) {
            if ($(div).scrollLeft() + containerWidth < cardCount * cardWidth) {
                $(div).animate({
                    scrollLeft: $(div).scrollLeft() + cardWidth
                }, {
                    duration: speed,
                    complete: function () {
                        setTimeout(
                            updateSliderArrowsStatus(
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
            updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
        });
        $("#slide-left-container").click(function (e) {
            if ($(div).scrollLeft() + containerWidth > containerWidth) {
                $(div).animate({
                    scrollLeft: "-=" + cardWidth
                }, {
                    duration: speed,
                    complete: function () {
                        setTimeout(
                            updateSliderArrowsStatus(
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
            updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
        });

        // If resize action ocurred then update the container width value
        $(window).resize(function () {
            try {
                containerWidth = $("#cards-container").width();
                updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
            } catch (error) {
                console.log(
                    `Error occured while trying to get updated slider container width: 
            ${error}`
                );
            }
        });

    }
    
    else {
        // Scroll products' slider left/right
        let div = $("#cards-container");
        let cardCount = $(div)
            .find(".cards")
            .children(".card").length;
        let speed = 200;
        let containerWidth = $(".containerSlider").width();
        let cardWidth = 215;

        updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);

        //Remove scrollbars
        $("#slide-right-container").click(function (e) {
            if ($(div).scrollLeft() + containerWidth < cardCount * cardWidth) {
                $(div).animate({
                    scrollLeft: $(div).scrollLeft() + cardWidth
                }, {
                    duration: speed,
                    complete: function () {
                        setTimeout(
                            updateSliderArrowsStatus(
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
            updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
        });
        $("#slide-left-container").click(function (e) {
            if ($(div).scrollLeft() + containerWidth > containerWidth) {
                $(div).animate({
                    scrollLeft: "-=" + cardWidth
                }, {
                    duration: speed,
                    complete: function () {
                        setTimeout(
                            updateSliderArrowsStatus(
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
            updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
        });

        // If resize action ocurred then update the container width value
        $(window).resize(function () {
            try {
                containerWidth = $("#cards-container").width();
                updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
            } catch (error) {
                console.log(
                    `Error occured while trying to get updated slider container width: 
            ${error}`
                );
            }
        });
    }
});
// End JS Slider Restaurant
