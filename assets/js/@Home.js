

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
