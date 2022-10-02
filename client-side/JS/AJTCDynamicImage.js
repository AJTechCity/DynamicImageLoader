class AJTCDynamicImage extends HTMLElement{
    constructor(){
        super();
        this.currentScale = 0;
        this.original_scale = 1;
    }
    
    connectedCallback(){
        this.url = this.getAttribute("src");
        //this.parentNode.removeChild(this);
        this._img = document.createElement("img");
        this._img.setAttribute("res", 0);
        this._img.onload = () => {
            this.loadNextImage();
        };
        var scale_index = this.url.indexOf("?s");
        if(scale_index >= 0){
            this.original_scale = this.url.substring(scale_index+3, this.url.length);
            this.url = this.url.substring(0, scale_index);
        }
        this.url = this.url.replace("?s=")
        this.parentNode.appendChild(this._img);
        
        this.loadNextImage();
        
        this._img.style.display = "block";
        this._img.style.display = "inline-block"; 
        this._img.style.height = "50vw";
        this._img.style.width = "50vw";
        
    }
    
    async loadNextImage(){
        this.currentScale = (parseFloat(this.currentScale)+0.1).toFixed(1);
        if(this.currentScale <= this.original_scale){
            this.xhr = new XMLHttpRequest();
            this.xhr.onreadystatechange = (e, scale = this.currentScale) => {
                if(this.xhr.readyState === 4 && this.xhr.status === 200){
                    this.r = new FileReader();
                    this.r.onloadend = () =>{
                        this._img.src = this.r.result;
                        this._img.setAttribute("res", scale);
                        this.loadNextImage();
                    };
                    this._res = this.xhr.response;
                    this.r.readAsDataURL(this._res);
                    this.xhr = null;
                    this._res=null;
                }
            }
            this.xhr.open("GET", this.url + `?s=${this.currentScale}`);
            this.xhr.setRequestHeader("Cache-Control", "no-cache, no-store, must-revalidate");
            this.xhr.setRequestHeader("Pragma", "no-cache");
            this.xhr.setRequestHeader("Expires", "0");
            this.xhr.responseType = 'blob';
            this.xhr.send();
        }
    }
}


window.customElements.define("ajtc-dynamic-image", AJTCDynamicImage);