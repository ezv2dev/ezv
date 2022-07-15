// TODO uncomment when active, start
    // translate per sentence
    // async function runTranslatePerSentence() {
    //     var data = $('.translate-text-single');
    //     for (let i = 0; i < data.length; i++) {
    //         // var textBeforeTranslate = $(data).eq(i).data('before-translate');
    //         var textBeforeTranslate = $(data).eq(i).text();
    //         try {
    //             const response = await fetch(`/translate-per-part?data=${textBeforeTranslate}`)
    //             var textAfterTranslate = await response.json();
    //             // console.log(textBeforeTranslate);
    //             // console.log(textAfterTranslate);
    //             $(data).eq(i).text('');
    //             $(data).eq(i).text(textAfterTranslate[0]);
    //         } catch (error) {
    //             // console.log(error);
    //         }
    //     }
    // }

    // function runTranslatePerGroupSentences() {
    //     var groups = $('.translate-text-group');
    //     if(groups.length > 0) {
    //         for (let i = 0; i < groups.length; i++) {
    //             const group = $(groups).eq(i).find('.translate-text-group-items');
    //             // console.log(`group ${i}`);
    //             // console.log(group.length);

    //             if(group.length > 0) {
    //                 var listBeforeTranslate = [];

    //                 // make list text before translate
    //                 for (let j = 0; j < group.length; j++) {
    //                     var item = $(group).eq(j).text();
    //                     var data = {
    //                         'index': j,
    //                         'text': `${item}`
    //                     };
    //                     listBeforeTranslate.push(data);
    //                 }

    //                 const chunkSize = 15;
    //                 for (let j = 0; j < listBeforeTranslate.length; j += chunkSize) {
    //                     const chunk = listBeforeTranslate.slice(j, j + chunkSize);
    //                     // console.log(chunk);
    //                     var listBeforeTranslateSplitPerChunk = JSON.stringify(chunk);
    //                     fetchTranslatePerGroup(group, listBeforeTranslateSplitPerChunk);
    //                 }
    //             }
    //         }
    //     }
    // }

    // async function fetchTranslatePerGroup(group, listBeforeTranslateSplitPerChunk) {
    //     try {
    //         const response = await fetch(`/translate?data=${listBeforeTranslateSplitPerChunk}`)
    //         var listAfterTranslate = await response.json();
    //         // console.log(listBeforeTranslateSplitPerChunk);
    //         // console.log(listAfterTranslate);
    //         for (let j = 0; j < listAfterTranslate.length; j++) {
    //             const item = listAfterTranslate[j];
    //             $(group).eq(item.index).text('');
    //             $(group).eq(item.index).text(item.text);
    //         }
    //     } catch (error) {
    //         // console.log(error);
    //     }
    // }

    // // run translate after loading
    // $(window).on('load', ()=>{
    //     runTranslatePerSentence();
    //     runTranslatePerGroupSentences();
    // });
// TODO end

// translate per group
// async function runTranslatePerGroupSentencesBackup() {
//     var groups = $('.translate-text-group');
//     if(groups.length > 0) {
//         for (let i = 0; i < groups.length; i++) {
//             const group = $(groups).eq(i).find('.translate-text-group-items');
//             console.log(`group ${i}`);
//             console.log(group.length);

//             if(group.length > 0) {
//                 var listBeforeTranslate = [];

//                 for (let j = 0; j < group.length; j++) {
//                     var item = $(group).eq(j).text();
//                     listBeforeTranslate.push(item);
//                 }

//                 listBeforeTranslate = JSON.stringify(listBeforeTranslate);

//                 try {
//                     const response = await fetch(`/translate?data=${listBeforeTranslate}`)
//                     var listAfterTranslate = await response.json();
//                     console.log(listBeforeTranslate);
//                     console.log(listAfterTranslate);
//                     for (let j = 0; j < group.length; j++) {
//                         const item = listAfterTranslate[j];
//                         $(group).eq(j).text('');
//                         $(group).eq(j).text(item);
//                     }
//                 } catch (error) {
//                     console.log(error);
//                 }
//             }
//         }
//     }
// }

