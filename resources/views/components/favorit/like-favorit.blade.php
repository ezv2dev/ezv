<script>
    async function likeFavorit(value, targetType) {
        let data;
        let postData;
        try {
            if (targetType == 'villa') {
                const postData = await $.ajax({
                    type: "GET",
                    url: `/like/villa/${value}`,
                    data: {
                        villa: value,
                        user: `{{ Auth::user()->id }}`,
                        _token: "{{ csrf_token() }}",
                    }
                });
                data = await postData;
            }
            if (targetType == 'restaurant') {
                const postData = await $.ajax({
                    type: "GET",
                    url: `/like/restaurant/${value}`,
                    data: {
                        restaurant: value,
                        user: `{{ Auth::user()->id }}`,
                        _token: "{{ csrf_token() }}",
                    }
                });
                data = await postData;
            }
            if (targetType == 'hotel') {
                const postData = await $.ajax({
                    type: "GET",
                    url: `/like/hotel/${value}`,
                    data: {
                        hotel: value,
                        user: `{{ Auth::user()->id }}`,
                        _token: "{{ csrf_token() }}",
                    }
                });
                data = await postData;
            }
            if (targetType == 'activity') {
                const postData = await $.ajax({
                    type: "GET",
                    url: `/like/things-to-do/${value}`,
                    data: {
                        activity: value,
                        user: `{{ Auth::user()->id }}`,
                        _token: "{{ csrf_token() }}",
                    }
                });
                data = await postData;
            }
        } catch (error) {
            console.log(error);
        }


        if (data) {
            if (data == 1) {
                console.log('like == true');
                $(`.likeButton${targetType+value}`).removeClass('favorite-button');
                $(`.likeButton${targetType+value}`).addClass('favorite-button-active');
                $(`.unlikeButton${targetType+value}`).removeClass('favorite-button');
                $(`.unlikeButton${targetType+value}`).addClass('favorite-button-active');

                $(`.like-sign-${targetType}-${value}`).fadeIn();
                setTimeout(function() {
                    $(`.like-sign-${targetType}-${value}`).fadeOut();
                }, 900);
            } else if (data == 0) {
                console.log('like == false');
                $(`.likeButton${targetType+value}`).removeClass('favorite-button-active');
                $(`.likeButton${targetType+value}`).addClass('favorite-button');
                $(`.unlikeButton${targetType+value}`).removeClass('favorite-button-active');
                $(`.unlikeButton${targetType+value}`).addClass('favorite-button');
            }
            // console.log('hit likeFavoriteMap');
            // console.log('likeButton : '+$(`.likeButton${targetType+value}`).attr('class'));
            // console.log('unlikeButton : '+$(`.unlikeButton${targetType+value}`).attr('class'));
            // console.log('like-sign : '+$(`.like-sign-${targetType}-${value}`).attr('class'));
        } else {
            console.log('fail to do action like');
        }
    }
</script>

