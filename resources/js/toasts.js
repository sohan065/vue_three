import toastr from "toastr";
import "toastr/build/toastr.css";

export function useToastr() {
    toastr.options.positionClass = "toast-bottom-right";
    toastr.options.closeButton = true;
    return toastr;
}
