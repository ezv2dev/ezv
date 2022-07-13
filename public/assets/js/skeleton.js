let childSkeleton = []
$(document).ready(function(){
    childSkeleton = []
    getSkeletonClass()
})

window.addEventListener("load", event => {
    console.log('window loaded')
    removeSkeletonClass()
});

function removeSkeletonClass(){
    console.log('remove class skeleton')
    let skeleton = document.querySelectorAll('.skeleton')

    skeleton.forEach(el => {
        childSkeleton.forEach(cl => {
            el.classList.remove(cl)
        })
    })
}

function getSkeletonClass(){
    let skeleton = document.querySelectorAll('.skeleton')
    skeleton.forEach(el => {
        let childClassSkeleton = el.classList
        childClassSkeleton.forEach(cl => {
            let splitClass = cl.split('-')
            if(splitClass[0] == 'skeleton') childSkeleton.push(cl)
        })
    })
}
