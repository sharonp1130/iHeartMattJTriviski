package help.me.orm.bo.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.IServiceBo;
import help.me.orm.dao.impl.ServiceDaoImpl;
import help.me.orm.entity.Service;

@Repository("serviceBo")
public class ServiceBoImpl implements IServiceBo {
	@Autowired
	ServiceDaoImpl dao;

	/* (non-Javadoc)
	 * @see help.me.orm.bo.IBo#getDao()
	 */
	@Override
	public ServiceDaoImpl getDao() {
		return dao;
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.IServiceBo#getIconFile(help.me.orm.entity.Service)
	 */
	@Override
	public String getIconFile(Service service) {
		// TODO Auto-generated method stub
		return null;
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.IServiceBo#getServiceWithDescription(java.lang.String)
	 */
	@Override
	public Service getServiceWithDescription(String description) {
		return dao.getServiceWithDescription(description);
	}

}
