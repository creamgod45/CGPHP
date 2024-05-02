

function closeViewImages(){
    let view_image_bg = document.querySelector("#view-image-bg");
    let view_image = document.querySelector("#view-image");
    let card_img = document.querySelector("#view-image .card-img");
    if(card_img!=null && view_image !=null && view_image_bg!=null){
        view_image_bg.style.display="none";
        view_image.style.display="none";
        document.body.style.overflow="";
    }
}

function htmlencode(txt){
    var div = document.createElement("div");
    div.appendChild(document.createTextNode(txt));
    return div.innerHTML;
}

function htmldecode(txt){
    var div = document.createElement("div");
    div.innerHTML=txt;
    return div.innerText||div.textContent;
}

function viewImages(el, txt){
    let imageUrl = el.src;
    getImageDimensions(imageUrl)
        .then(dimensions => {
            //console.log('Image dimensions:', dimensions);
            let view_image_bg = document.querySelector("#view-image-bg");
            let view_image = document.querySelector("#view-image");
            let card_img = document.querySelector("#view-image .card-img");
            let card_text = document.querySelector("#view-image .card-img .card-body .card-text");
            if(card_img!=null && view_image !=null && view_image_bg!=null){
                //console.log(view_image_bg,view_image,card_img);
                view_image_bg.style.display="unset";
                view_image.style.display="flex";
                card_img.style.backgroundImage="url('%url%')".replace("%url%", imageUrl);
                card_img.style.width=dimensions.width/2+"px";
                card_img.style.height=dimensions.height/2+"px";
                document.body.style.overflow="hidden";
                try {
                    card_text.innerHTML=atob(txt);
                }catch (e) {
                    card_text.innerHTML=txt;
                }
            }
        }).catch(error => console.error('Failed to load image:', error));
}

function getImageDimensions(url) {
    return new Promise((resolve, reject) => {
        const img = new Image();

        // Set up the image
        img.onload = () => {
            resolve({ width: img.width, height: img.height });
        };
        img.onerror = reject;

        // Set the source of the image to the provided URL
        img.src = url;
    });
}

function test_encode(){
    let startTime = performance.now();
    let encodeContext1 = encodeContext("在人生的歷程中，yee的出現是必然的。在這種不可避免的衝突下，我們必須解決這個問題。我們要學會站在別人的角度思考。就我個人來說，yee對我的意義，不能不說非常重大。由於，茅盾曾經提過，過去的，讓它過去，永遠不要回顧; 未來的，等來了時再說，不要空想; 我們只抓住了現在，用我們現在的理想，做我們所應該做的。這讓我的思緒清晰了。要想清楚，yee，到底是一種怎麼樣的存在。做好yee這件事，可以說已經成為了全民運動。阿拉伯曾經說過，經歷重大變故的人，容易成為智者。希望大家能發現話中之話。yee的存在，令我無法停止對他的思考。李區特深信，一個人在描述他人的個性時，其自身的個性即暴露無遺。這不禁令我深思。布拉德利說過一句經典的名言，最後一位格言裡，凝固在冷峻的警句中。我們心中的熱血，在我們蘸取書寫的瞬間，化作暗淡的墨跡。這句話語雖然很短，但令我浮想聯翩。\n" +
        "\n" +
        "        我認為，這樣看來，伊朗說過一句發人省思的話，一個沒有知識的旅行者等於一隻沒翅膀的鳥兒。這句話把我們帶到了一個新的維度去思考這個問題。我們一般認為，抓住了問題的關鍵，其他一切則會迎刃而解。一般來說，我們不得不面對一個非常尷尬的事實，那就是，培根曾說過，無論你怎樣地表示憤怒，都不要做出任何無法挽回的事來。這啟發了我。總結來說，謹慎地來說，我們必須考慮到所有可能。世界上若沒有yee，對於人類的改變可想而知。yee的出現，重寫了人生的意義。我們都很清楚，這是個嚴謹的議題。吳晗說過一句富有哲理的話，在學習上做一眼勤、手勤、腦勤，就可以成為有學問的人。這句話幾乎解讀出了問題的根本。奧維德曾經提到過，在我們這個時代裡，單純十分罕見。這句話令我不禁感慨問題的迫切性。經過上述討論，別林斯基曾說過，土地是以它的肥沃和收穫而被估價的; 才能也是土地，不過它生產的不是糧食，而是真理。如果只能滋生瞑想和幻想的話，即使再大的才能也只是砂地或鹽池，那上面連小草也長不出來的。這段話令我陷入了沈思。我們都有個共識，若問題很困難，那就勢必不好解決。當前最急迫的事，想必就是釐清疑惑了。其實，若思緒夠清晰，那麼yee也就不那麼複雜了。世界需要改革，需要對yee有新的認知。yee對我來說，已經成為了我生活的一部分。動機，可以說是最單純的力量。對於yee，我們不能不去想，卻也不能走火入魔。yee勢必能夠左右未來。這種事實對本人來說意義重大，相信對這個世界也是有一定意義的。說到yee，你會想到什麼呢？面對如此難題，我們必須設想周全。那麼，yee似乎是一種巧合，但如果我們從一個更大的角度看待問題，這似乎是一種不可避免的事實。");
    console.log(encodeContext1);

    let formData = new FormData();
    formData.append('a', encodeContext1.compress);
    fetch('/api/lz_string.php', {
        body: formData,
        method: "POST"
    }).then(async response => {
        if (response.ok) {
            let json = await response.json();
            console.log(json);
        }
    })

    let endTime = performance.now();
    // 計算總運行時間
    let elapsedTime = endTime - startTime;
    console.log(`程式運行時間：${elapsedTime} 毫秒`);
}

document.addEventListener('DOMContentLoaded', test_encode);
