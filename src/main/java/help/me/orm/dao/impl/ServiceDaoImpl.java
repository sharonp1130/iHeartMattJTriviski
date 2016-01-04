package help.me.orm.dao.impl;

import org.hibernate.criterion.Restrictions;
import org.springframework.stereotype.Repository;

import help.me.orm.dao.IServiceDao;
import help.me.orm.entity.Service;

/**
 * License DAO implementation.
 * 
 * @author triviski
 *
 */
@Repository("serviceDao")
public class ServiceDaoImpl extends CustomHibernateDAOSupport<Service> implements IServiceDao {

	/* (non-Javadoc)
	 * @see help.me.orm.dao.IServiceDao#getServiceWithDescription(java.lang.String)
	 */
	@Override
	public Service getServiceWithDescription(String description) {
		return (Service) getCurrentSession().createCriteria(Service.class)
				.add(Restrictions.eq("description", description))
				.uniqueResult();
	}
}

