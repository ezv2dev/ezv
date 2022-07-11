let childSkeleton = []
$(document).ready(function(){
    childSkeleton = []
    getSkeletonClass()
})

window.onload = () => {
    removeSkeletonClass()
}

function removeSkeletonClass(){
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
