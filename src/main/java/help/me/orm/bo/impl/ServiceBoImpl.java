package help.me.orm.bo.impl;

import java.util.Collection;
import java.util.List;

import org.hibernate.criterion.Projections;
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
	 * @see help.me.orm.bo.IServiceBo#getServiceWithServiceName(java.lang.String)
	 */
	@Override
	public Service getServiceWithServiceName(String description) {
		return dao.getWithServiceName(description);
	}
	
	
	@Override
	@SuppressWarnings("unchecked")
	public Collection<String> getServiceNames() {
		List<String> results = dao.getCurrentSession().createCriteria(Service.class)
			.setProjection(Projections.property("serviceName"))
			.list();

		return results;
	}

	@SuppressWarnings("unchecked")
	@Override
	public Collection<Service> getServices() {
		return dao.getCurrentSession().createCriteria(Service.class)
			.list();
	}
}
