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
	 * @see help.me.orm.bo.IServiceBo#getServiceWithDescription(java.lang.String)
	 */
	@Override
	public Service getServiceWithDescription(String description) {
		return dao.getServiceWithDescription(description);
	}

	@Override
	@SuppressWarnings("unchecked")
	public Collection<String> getServiceDescriptions() {
		List<String> results = dao.getCurrentSession().createCriteria(Service.class)
			.setProjection(Projections.property("description"))
			.list();

		return results;
	}
}
