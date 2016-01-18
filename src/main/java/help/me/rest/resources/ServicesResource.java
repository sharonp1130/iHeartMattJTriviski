package help.me.rest.resources;

import org.springframework.beans.factory.annotation.Autowired;

import help.me.orm.bo.impl.ServiceBoImpl;

/**
 * Resource for getthing the available resources. 
 * 
 * @author triviski
 *
 */
public class ServicesResource extends BaseResource {
	@Autowired
	ServiceBoImpl serviceBo;
}
