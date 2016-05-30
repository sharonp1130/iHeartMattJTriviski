package help.me.orm.dao;

import help.me.orm.entity.Service;

/**
 * DAO for Service.  Doesn't have any special values at this point.
 * @author triviski
 *
 */
public interface IServiceDao extends IDao<Service> {
	
	/**
	 * Finds the service with description.  
	 * @param description
	 * @return Service object null if found
	 */
	public Service getWithServiceName(String description);
}
