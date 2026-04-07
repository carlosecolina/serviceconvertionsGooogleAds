/**
 *
 * DropzoneTemplates
 *
 * Dropzone Preview Templates
 *
 *
 */

 class DropzoneTemplates {
    // No icon for file types, only an image
    static previewImageTemplate = `
        <div class="dz-preview dz-file-preview mb-3">
          <div class="d-flex flex-row">
              <div class="p-0 position-relative image-container">
                  <div class="preview-container">
                      <img data-dz-thumbnail class="img-thumbnail border-0" />
                  </div>
                  <div class="dz-error-mark">
                      <i class="cs-close-circle"></i>
                  </div>
                  <div class="dz-success-mark">
                    <i class="cs-check"></i>
                  </div>
              </div>
              <div class="ps-3 pt-2 pe-2 pb-1 dz-details position-relative">
                  <div><span data-dz-name></span></div>
                  <div class="text-primary text-extra-small" data-dz-size />
                  <div class="dz-error-message"><span data-dz-errormessage></span></div>
              </div>
              <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
              <div class="dz-error-message"><span data-dz-errormessage></span></div>
          </div>
          <a href="#/" class="remove" data-dz-remove><i class="cs-bin"></i></a>
      </div>`;
  
    // Standard preview template
    static previewTemplate = `
    <div class="mt-2 p-4 dz-preview dz-file-preview mb-1 gap-4">
        <div class="flex flex-row h-20">
            <div class="p-0 relative image-container">
                <div class="preview-container">
                    <img data-dz-thumbnail class="h-full !w-auto !max-w-[unset] aspect-square object-cover object-center border-0" />
                    <i class="cs-file-text preview-icon"></i>
                </div>
                <div class="dz-error-mark">
                    <i class="cs-close-circle"></i>
                </div>
                <div class="dz-success-mark">
                    <i class="cs-check"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                    <linearGradient id="HoiJCu43QtshzIrYCxOfCa_VFaz7MkjAiu0_gr1" x1="21.241" x2="3.541" y1="39.241" y2="21.541" gradientUnits="userSpaceOnUse"><stop offset=".108" stop-color="#0d7044"></stop><stop offset=".433" stop-color="#11945a"></stop></linearGradient><path fill="url(#HoiJCu43QtshzIrYCxOfCa_VFaz7MkjAiu0_gr1)" d="M16.599,41.42L1.58,26.401c-0.774-0.774-0.774-2.028,0-2.802l4.019-4.019	c0.774-0.774,2.028-0.774,2.802,0L23.42,34.599c0.774,0.774,0.774,2.028,0,2.802l-4.019,4.019	C18.627,42.193,17.373,42.193,16.599,41.42z"></path><linearGradient id="HoiJCu43QtshzIrYCxOfCb_VFaz7MkjAiu0_gr2" x1="-15.77" x2="26.403" y1="43.228" y2="43.228" gradientTransform="rotate(134.999 21.287 38.873)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#2ac782"></stop><stop offset="1" stop-color="#21b876"></stop></linearGradient><path fill="url(#HoiJCu43QtshzIrYCxOfCb_VFaz7MkjAiu0_gr2)" d="M12.58,34.599L39.599,7.58c0.774-0.774,2.028-0.774,2.802,0l4.019,4.019	c0.774,0.774,0.774,2.028,0,2.802L19.401,41.42c-0.774,0.774-2.028,0.774-2.802,0l-4.019-4.019	C11.807,36.627,11.807,35.373,12.58,34.599z"></path>
                    </svg></i>
                </div>
            </div>
            <div class="ps-3 pt-2 pe-2 pb-1 dz-details relative">
                <div><span data-dz-name></span></div>
                <div class="text-primary text-xs" data-dz-size></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
            </div>
            
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
        </div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
        <a href="#/" class="remove " data-dz-remove><i class="cursor-pointer fa fa-trash-alt"></i> </a>
    </div>
        `;
  
    // Column template
    static columnPreviewImageTemplate = `
          <div class="dz-preview dz-file-preview col border-0 h-auto me-0">
              <div class="d-flex flex-column border rounded-md">
                  <div class="p-0 position-relative image-container w-100">
                      <div class="preview-container rounded-0 rounded-md-top">
                          <img data-dz-thumbnail class="img-thumbnail border-0 rounded-0 rounded-md-top sh-18" />
                      </div>
                      <div class="dz-error-mark">
                          <i class="cs-close-circle"></i>
                      </div>
                      <div class="dz-success-mark">
                          <i class="cs-check"></i>
                      </div>
                  </div>
                  <div class="ps-3 pt-3 pe-2 pb-1 dz-details position-relative w-100">
                      <div><span data-dz-name></span></div>
                      <div class="text-primary text-extra-small" data-dz-size />
                      <div class="dz-error-message"><span data-dz-errormessage></span></div>
                  </div>
                  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                  <div class="dz-error-message"><span data-dz-errormessage></span></div>
              </div>
              <a href="#/" class="remove" data-dz-remove><i class="cs-bin"></i></a>
          </div>`;
  }
  