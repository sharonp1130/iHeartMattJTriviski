//package help.me.rest.resources;
//
//import java.util.Map;
//
//import javax.servlet.http.HttpServletRequest;
//
//import org.springframework.beans.factory.annotation.Autowired;
//import org.springframework.boot.autoconfigure.web.ErrorAttributes;
//import org.springframework.boot.autoconfigure.web.ErrorController;
//import org.springframework.util.Assert;
//import org.springframework.web.bind.annotation.RequestMapping;
//import org.springframework.web.bind.annotation.RestController;
//import org.springframework.web.context.request.RequestAttributes;
//import org.springframework.web.context.request.ServletRequestAttributes;
//
//@RestController
//@RequestMapping(value = "/error")
//public class IndexController implements ErrorController {
//
//    private static final String PATH = "/error";
//    private final ErrorAttributes errorAttributes;
//
//    
//    /* (non-Javadoc)
//     * @see org.springframework.boot.autoconfigure.web.ErrorController#getErrorPath()
//     */
//    @Override
//    public String getErrorPath() {
//        return PATH;
//    }
//    
//
//    /**
//     * @param errorAttributes
//     */
//    @Autowired
//    public IndexController(ErrorAttributes errorAttributes) {
//      Assert.notNull(errorAttributes, "ErrorAttributes must not be null");
//      this.errorAttributes = errorAttributes;
//    }
//
//    /**
//     * @param aRequest
//     * @return
//     */
//    @RequestMapping
//    public Map<String, Object> error(HttpServletRequest aRequest){
//      Map<String, Object> body = getErrorAttributes(aRequest,   
//      getTraceParameter(aRequest));
//      return body;
//    }
//
//    /**
//     * @param request
//     * @return
//     */
//    private boolean getTraceParameter(HttpServletRequest request) {
//      String parameter = request.getParameter("trace");
//      if (parameter == null) {
//          return false;
//      }
//      return !"false".equals(parameter.toLowerCase());
//    }
//
//    /**
//     * @param aRequest
//     * @param includeStackTrace
//     * @return
//     */
//    private Map<String, Object> getErrorAttributes(HttpServletRequest aRequest, boolean includeStackTrace) {
//      RequestAttributes requestAttributes = new ServletRequestAttributes(aRequest);
//      return errorAttributes.getErrorAttributes(requestAttributes, includeStackTrace);
//    }
//}