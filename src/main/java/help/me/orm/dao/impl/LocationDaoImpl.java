package help.me.orm.dao.impl;

import org.springframework.stereotype.Repository;

import help.me.orm.dao.ILocationDao;
import help.me.orm.entity.Location;

/**
 * Location DAO implementation.
 * 
 * @author triviski
 *
 */
@Repository("locationDao")
public class LocationDaoImpl extends CustomHibernateDAOSupport<Location> implements ILocationDao {
}

