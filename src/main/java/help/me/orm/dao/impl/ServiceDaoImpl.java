package help.me.orm.dao.impl;

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
}

