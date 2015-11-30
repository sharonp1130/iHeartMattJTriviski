package help.me.orm.dao.impl;

import org.springframework.stereotype.Repository;

import help.me.orm.dao.ISettingsDao;
import help.me.orm.entity.Settings;

/**
 * Settings DAO implementation.
 * 
 * @author triviski
 *
 */
@Repository("settingsDao")
public class SettingsDaoImpl extends CustomHibernateDAOSupport<Settings> implements ISettingsDao {
}

