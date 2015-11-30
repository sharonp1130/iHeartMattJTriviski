package help.me.orm.dao.impl;

import org.springframework.stereotype.Repository;

import help.me.orm.dao.ILicenseDao;
import help.me.orm.entity.License;

/**
 * License DAO implementation.
 * 
 * @author triviski
 *
 */
@Repository("licenseDao")
public class LicenseDaoImpl extends CustomHibernateDAOSupport<License> implements ILicenseDao {
}

