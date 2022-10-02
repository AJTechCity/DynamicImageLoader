class AJTCDynamicImage extends HTMLElement{
    constructor(){
        super();
        this.currentScale = 0;
        this.original_scale = 1;
    }
    
    connectedCallback(){
        this.url = this.getAttribute("src");
        
        this.xhr = new XMLHttpRequest();
        this.xhr.onload = () => {
            
        }

        this._img = document.createElement("img");
        this._img.onload = () => {
            this.loadNextImage();
        };
        var scale_index = this.url.indexOf("?s");
        if(scale_index >= 0){
            this.original_scale = this.url.substring(scale_index+3, this.url.length);
            this.url = this.url.substring(0, scale_index);
        }
        this.url = this.url.replace("?s=")
        this._img.src = this.url+"?s=0.1";
        this.parentNode.appendChild(this._img);
        
        this.loadNextImage();
        
        this._img.style.display = "block";
        this._img.style.display = "inline-block"; 
        this._img.style.height = "50vw";
        this._img.style.width = "50vw";
        
    }
    
    async loadNextImage(){
        if(this.currentScale < this.original_scale){
            //console.log(`Current Scale: ${this.currentScale} -> Original Scale: ${this.original_scale}`);
            this.currentScale = (parseFloat(this.currentScale)+0.1).toFixed(1);
            this._img.src = this.url + `?s=${this.currentScale}`;
        }
    }
}


window.customElements.define("ajtc-dynamic-image", AJTCDynamicImage);

/*async function AJTCDynamicImage(url){
    console.log(url)
}

const imgs = document.getElementsByClassName("AJTC-Dynamic-Image");
for (var img in imgs){
    AJTCDynamicImage(img.getAttribute("src"));
    img.setAttribute("src", null);
}*/

console.log("h");