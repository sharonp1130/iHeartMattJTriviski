package help.me.orm.dao.impl;

import org.springframework.stereotype.Repository;

import help.me.orm.dao.IInfoDao;
import help.me.orm.entity.Info;

/**
 * Info DAO implementation.
 * 
 * @author triviski
 *
 */
@Repository("infoDao")
public class InfoDaoImpl extends CustomHibernateDAOSupport<Info> implements IInfoDao {}

